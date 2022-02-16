<div class="container">
    <div class="dataset-resource-views">
        <div class="resource-views-header">
            <div class="resource-selector-header">
                FILES DI DATSET INI
            </div>
        </div>
        <div class="resource-views-body">
            <div class="resource-detail-container" style="padding: 10px 10px 10px 10px !important; background-color: white !important;">
                <div class="resource-detail container-fluid" style="padding: 0px 0px !important;">
                    <div class="resource-controls">
                        <span>Tampilan: </span>
                        <a class="view-tab ga-dataset-resource-view-selector chart" data-ga="Chart" href="{{ url('dataset') }}/{{ $dataset->slug }}?view_id=4887311f-8757-4500-8a7e-886a6577a269">
                            <div></div>
                            <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/chart.svg')}}">
                            <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/active/chart.svg')}}">
                            <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/chart.svg')}}">
                        </a>
                        <a class="view-tab ga-dataset-resource-view-selector table" data-ga="Table" href="{{ url('dataset') }}/{{ $dataset->slug }}?view_id=28bf9fb4-65a2-4378-a791-beac78cf789">
                            <div></div>
                            <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/active/table.svg')}}">
                            <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/table.svg')}}">
                            <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/table.svg')}}">
                        </a>
                        <a class="view-tab ga-dataset-resource-view-selector active maps" data-ga="Maps" href="{{ url('dataset') }}/{{ $dataset->slug }}?view_id=192ce991-fcd7-4aa0-9a37-628b9a483bca">
                            <div></div>
                            <img class="active" src="{{ asset('images/frontend/icons/resource_view_selectors/active/map.svg')}}">
                            <img class="inactive" src="{{ asset('images/frontend/icons/resource_view_selectors/inactive/map.svg')}}">
                            <img class="inactive hover" src="{{ asset('images/frontend/icons/resource_view_selectors/hover/map.svg')}}">
                        </a>
                    </div>
                    <div class="resource-view map-view" >
                        <iframe frameborder="0" src="{{ url('imaps') }}/{{ $dataset->api_id }}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>