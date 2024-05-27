<?php
class Pages extends CI_Controller {

    public function view($page = 'home') {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
            {
                show_404();
            }
    
            $data['title'] = ucfirst($page); // Capitalize the first letter
            
            if ($page == 'home'){
                $data['volumes'] = $this->Volume_model->get_volumes_with_articles();
            }

            if ($page == 'articles'){
                $data['articles'] = $this->Article_model->get_published_articles();
            }
    
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer', $data);
    }
}