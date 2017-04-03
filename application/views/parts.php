<div class="center-it pad-top-bot">
    <a href="/work/mybuilds" class="btn btn-info" role="button">Build more parts</a>
    <a href="/work/buybox" class="btn btn-info" role="button">Buy parts</a>
</div>
<div class="container container-fluid partscontainer">
    {parts}
    <div class="col-sm-4 parts">
        <a href="/part/{id}">
            <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
        </a>
        <h5>Part type: {partType}</h5>
        <h5>Line: {modelType}</h5>
    </div>
    {/parts}
</div>
