<div class="container container-fluid partscontainers"> 
    {results}
        <font color="red"><b>{output}</b></font>
        <br/>
    {/results}
    <div class="center-it pad-top-bot">
        <a href="/part/buildParts" class="btn btn-info" role="button">Build more parts</a>
        <a href="/part/buyBox" class="btn btn-info" role="button">Buy parts</a>
    </div>
    <div class="container container-fluid partscontainer">
        {parts}
        <div class="col-sm-4 parts">
            <a href="/part/{id}">
                <img class="img-responsive" src="/img/parts/{partCode}.png" title="{partCode}">
            </a>
            <h5>Line: {modelType}</h5>
            <h5>Part type: {partType}</h5>
            <h5>CA code: {caCode}</h5>
        </div>
        {/parts}
    </div>
</div>