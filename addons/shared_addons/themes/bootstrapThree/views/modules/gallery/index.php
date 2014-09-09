<script>
    $(document).ready(function() {
        $(".boxer").not(".retina, .boxer_fixed, .boxer_top, .boxer_format, .boxer_mobile, .boxer_object").boxer();

        $(".boxer.boxer_fixed").boxer({
            fixed: true
        });

        $(".boxer.boxer_top").boxer({
            top: 50
        });

        $(".boxer.retina").boxer({
            retina: true
        });

        $(".boxer.boxer_format").boxer({
            formatter: function($target) {
                return '<h3>' + $target.attr("title") + "</h3>";
            }
        });

        $(".boxer.boxer_mobile").boxer({
            mobile: true
        });
    });
</script>
<?php
function getParam($param, $default) {
    $result = $default;
    if (isset($param)) {
        $result = (get_magic_quotes_gpc()) ? $param : addslashes($param);
    }
    return trim($result);
}
function getYoutubeID($url) {
    $tube = parse_url($url);
    if ($tube["path"] == "/watch") {
        parse_str($tube["query"], $query);
        $id = $query["v"];
    } else {
        $id = "";   
    }
    return $id;
}
//$url = getParam($_GET['url'], "http://www.youtube.com/watch?v=aDaOgu2CQtI");
//$id = getYoutubeID($url);
?>
<div class="container">
    <div class="row mtop10">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Galería</h1>
            <p>{{ intro.text }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#image_1" role="tab" data-toggle="tab">Tipo 1</a></li>
              <li><a href="#image_2" role="tab" data-toggle="tab">Tipo 2</a></li>
              <li><a href="#image_3" role="tab" data-toggle="tab">Tipo 3</a></li>
              <li><a href="#video" role="tab" data-toggle="tab">videos</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="row">
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="image_1">
                    {{ gallery }}
                        {{ if type == 1 }}
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mtop20">
                                <a class="fancybox" href="{{ content }}" data-fancybox-group="gallery" title="{{ title }}">
                                    <div class="gallery_tipe_1 shadow">
                                        <img src="{{ content }}" alt="{{ title }}" />
                                         <!--<div class="title-gallery">{{ title }}</div> -->
                                    </div>  
                                </a>
                            </div>                           
                        {{ endif }}
                    {{ /gallery }}
                  </div>
                  <div class="tab-pane fade" id="image_2">
                        <div class="main">
                            <ul id="og-grid" class="og-grid">
                                <li>
                                    <a href="http://cargocollective.com/jaimemartinez/" data-largesrc="images/1.jpg" data-title="Azuki bean" data-description="Swiss chard pumpkin bunya nuts maize plantain aubergine napa cabbage soko coriander sweet pepper water spinach winter purslane shallot tigernut lentil beetroot.">
                                        <img src="images/thumbs/1.jpg" alt="img01"/>
                                    </a>
                                </li>  
                            </ul>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="image_3">Tipo 3</div>
                  <div class="tab-pane fade" id="video">
                      {{ gallery }}
                        {{ if type == 2 }}

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mtop20">
                                <a href="{{content}}?rel=0" class="boxer button small" data-gallery="video_gallery" title="">
                                    <img src="{{content_img}}" height="121" width="221" alt="" />
                                </a>

                            </div>  

                        {{ endif }}
                    {{ /gallery }}
                  </div>
            </div>
                
            </div>

    	</div>
    </div>

     
    {{ pagination }}
</div>
<div class="push"></div>
