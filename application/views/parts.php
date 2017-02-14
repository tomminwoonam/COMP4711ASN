<div class="container container-fluid partscontainer">
        {parts}
        <div class="col-sm-4 parts">
            <a href="/parts/{id}">
                <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
            </a>
            <h5>Part type: {partType}</h5>
            <h5>Line: {modelType}</h5>
        </div>
        {/parts}
</div>
