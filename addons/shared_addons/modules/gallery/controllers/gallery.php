<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Brayan Acebo
 */
class Gallery extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            'gallery_model',
            'gallery_intro_model'
            );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación
        $pagination = create_pagination('gallery/index', $this->gallery_model->count_all(), 16, 3);

        // Galeria
        $gallery = $this->gallery_model
        ->limit($pagination['limit'], $pagination['offset'])
        ->order_by('id', 'DESC')
        ->get_all();

        foreach($gallery AS $item)
        {
            if($item->type == 1){
                $item->content = val_image($item->content);
                $item->title = substr($item->title, 0,200);
            }else{
                $videoJson = json_decode(file_get_contents('http://www.youtube.com/oembed?url=' . $item->content . '&format=json'));
                $item->content_img = $videoJson->thumbnail_url;
                preg_match('/src="([^"]+)"/', $videoJson->html, $match);
                $url = $match[1];
                $item->content = $url;
            }
        }

        // Intro
        $in = $this->gallery_intro_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }

        $this->template
		->append_css('module::photobox.css')
        ->append_js('module::admin/photobox.min.js')
        ->set('pagination', $pagination['links'])
        ->set('gallery', $gallery)
        ->set('intro', $intro)
        ->build('index');
    }

}