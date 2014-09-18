{{ if albums }}
{{ albums }}
<div class="col-sx-12 col-sm-6 col-md-4 col-lg-4">
    <div class="cont-prod">
        <div class="cont-img-prod">
            <img src="{{image}}" alt="{{title}}">
        </div>
        <div class="cont">
            <h4>{{ name }}</h4>
            <div class="intro">{{ introduction }}</div>
            <span class="price">{{ price }}</span>
            <a href="{{ url }}" class="btn btn-primary">Ver Mas</a>
        </div>
    </div>
</div>
{{ /albums }}
{{ else }}
<div class="col-sm-12 col-md12" id="stop_scroll"><p style="text-align:center;margin-top:80px"><strong>No se encontraron resultados...</strong></p></div>
{{ endif }}