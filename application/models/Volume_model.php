<?php
class Volume_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function get_volumes() {
        $query = $this->db->get('volume');
        return $query->result_array();
    }

    public function get_volumes_with_articles() {
        $this->db->select('volume.volumeid, volume.vol_name, volume.coverImg, volume.description, 
                           articles.articleid, articles.title, articles.doi, articles.date_published, articles.filename, articles.abstract, articles.published, 
                           GROUP_CONCAT(DISTINCT users.complete_name ORDER BY users.complete_name SEPARATOR ", ") as author_names');
        $this->db->from('volume');
        $this->db->join('articles', 'articles.volumeid = volume.volumeid AND articles.published = 1', 'left');
        $this->db->join('article_author', 'article_author.articleid = articles.articleid', 'left');
        $this->db->join('authors', 'authors.auid = article_author.auid', 'left');
        $this->db->join('users', 'users.userid = authors.userid', 'left');
        $this->db->where('volume.published', 1);
        $this->db->group_by('volume.volumeid, articles.articleid');
        
        $query = $this->db->get();
        $result = $query->result_array();

        $volumes = [];
        foreach ($result as $row) {
            $volumeId = $row['volumeid'];
            if (!isset($volumes[$volumeId])) {
                $volumes[$volumeId] = [
                    'vol_name' => $row['vol_name'],
                    'coverImg' => $row['coverImg'],
                    'description' => $row['description'],
                    'articles' => []
                ];
            }

            $article = [
                'articleid' => $row['articleid'],
                'title' => $row['title'],
                'abstract' => $row['abstract'],
                'published' => $row['published'],
                'filename' => $row['filename'],
                'doi' => $row['doi'],
                'date_published' => $row['date_published'],
                'author_names' => $row['author_names']
            ];

            $volumes[$volumeId]['articles'][] = $article;
        }

        return $volumes;
    }

    public function delete_volume($volumeid) {
        $query = $this->db->get_where('volume', array('volumeid' => $volumeid));
        $data =  $query->row_array();

        $fullPathToDelete = 'assets/images/volumes/'. $data['coverImg'];

        if (file_exists($fullPathToDelete) && $data['coverImg'] !== 'default.png') {
            unlink($fullPathToDelete);
        }

        $this->db->where('volumeid', $volumeid);
        $this->db->delete('volume');

        $this->db->where('volumeid', $volumeid);
        $this->db->delete('articles');
    }

    public function get_volumes_unpublished() {
        $this->db->where('published', 0);
        $query = $this->db->get('volume');

        return $query->result_array();
    }

    public function get_specific_volume($volumeid) {
        $this->db->where('volumeid', $volumeid);
        $query = $this->db->get('volume');

        return $query->row_array();
    }

    public function update_volume() {

        $this->db->where('volumeid', $this->input->post('volumeid'));
        $query = $this->db->get('volume');

        $data = $query->row_array();

        $published = ($data['published'] == 1) ? 1 : 0;
        $archived = ($data['archived'] == 1) ? 1 : 0;

        $file_name = $data['coverImg'];

        $fullPathToDelete = 'assets/images/volumes/'. $data['coverImg'];

        if (!empty($_FILES['coverImg']['name'])) {

            $config['upload_path'] = './assets/images/volumes/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('coverImg')) {
                $data = $this->upload->data();
                $file_name = $data['file_name'];

                if (file_exists($fullPathToDelete) && $data['coverImg'] !== 'default.png') {
                    unlink($fullPathToDelete);
                }
            }
        } else {
            $file_name = $data['coverImg'];
        }

        $data = array(
            'vol_name' => $this->input->post('vol_name'),
            'description' => $this->input->post('description'),
            'coverImg' => $file_name,
            'published' => $published,
            'archived' => $archived,
        );

        $this->db->where('volumeid', $this->input->post('volumeid')); 
        $this->db->update('volume', $data);
    }

    public function publish_volume($volumeid) {
        $status = ($this->get_current_publish_status($volumeid) == 1 ) ? 0 : 1;

        $this->db->set('published', $status);
        $this->db->where('volumeid', $volumeid);
        $this->db->update('volume');
    }

    private function get_current_publish_status($volumeid) {
        $query = $this->db->get_where('volume', array('volumeid' => $volumeid));
        return $query->row()->published;
    }

    public function get_volume_count() {
        $this->db->from('volume');
        return $this->db->count_all_results();
    }
}
