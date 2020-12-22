@extends('layouts.app')

@section('header')
<title>Home | A.med</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
@endsection

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
    </button>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <div class="container">
        

        

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#yorkminster" aria-controls="home" role="tab" data-toggle="tab">York Minster</a></li>
            <li role="presentation"><a href="#yorkcastle" aria-controls="profile" role="tab" data-toggle="tab">York Castle</a></li>
            <li role="presentation"><a href="#yorkmuseumgardens" aria-controls="profile" role="tab" data-toggle="tab">York Museum Gardens</a></li>
            <li role="presentation"><a href="#yorkdungeon" aria-controls="profile" role="tab" data-toggle="tab">York Dungeon</a></li>
            <li role="presentation"><a href="#theshambles" aria-controls="profile" role="tab" data-toggle="tab">The Shambles</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="yorkminster">
                <h3>York Minster</h3>
                <p>The <strong>Cathedral and Metropolitical Church of Saint Peter in York</strong>, commonly known 
                    as <strong>York Minster</strong>, is the cathedral of York, England, and is one of the largest 
                    of its kind in Northern Europe. The minster is the seat of the Archbishop of York, the second-highest 
                    office of the Church of England, and is the mother church for the Diocese of York and the Province 
                    of York. It is run by a dean and chapter, under the Dean of York. The title "minster" is attributed 
                    to churches established in the Anglo-Saxon period as missionary teaching churches, and serves now 
                    as an honorific title. Services in the minster are sometimes regarded as on the High Church or 
                    Anglo-Catholic end of the Anglican continuum.</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="yorkcastle">
                <h3>York Castle</h3>
                <p><strong>York Castle</strong> in the city of York, England, is a fortified complex comprising, over 
                    the last nine centuries, a sequence of castles, prisons, law courts and other buildings on the 
                    south side of the River Foss. The now-ruinous keep of the medieval Norman castle is commonly 
                    referred to as <strong>Clifford's Tower</strong>. Built originally on the orders of William I to 
                    dominate the former Viking city of York, the castle suffered a tumultuous early history before 
                    developing into a major fortification with extensive water defences. After a major explosion in 
                    1684 rendered the remaining military defences uninhabitable, York Castle continued to be used as 
                    a jail and prison until 1929.</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="yorkmuseumgardens">
                <h3>York Museum Gardens</h3>
                <p>The <strong>York Museum Gardens</strong> are botanic gardens in the centre of York, England, beside 
                    the River Ouse. They cover an area of 10 acres (4.0 ha) of the former grounds of St Mary's Abbey, 
                    and were created in the 1830s by the Yorkshire Philosophical Society along with the Yorkshire 
                    Museum which they contain.</p>
            </div>
            <div role="tabpanel" class="tab-pane" id="yorkdungeon">
                <h3>York Dungeon</h3>
                <p><strong>York Dungeon</strong> is a tourist attraction in York, England. York Dungeon depicts history 
                    of the dungeon using actor led shows, special effects and displays of models and objects.</p>
                <p>The York Dungeons reopened in March 2013 after a period of closure due to severe flooding.</p>
            </div>   
            <div role="tabpanel" class="tab-pane" id="theshambles">
                <h3>The Shambles</h3>
                <p><strong>The Shambles</strong> (official name <strong>Shambles</strong>) is an old street in York, 
                    England, with overhanging timber-framed buildings, some dating back as far as the fourteenth century. 
                    It was once known as <strong>The Great Flesh Shambles</strong>, probably from the Anglo-Saxon 
                    Fleshammels (literally 'flesh-shelves'), the word for the shelves that butchers used to display 
                    their meat. As recently as 1872 twenty-five butchers' shops were located along the street, but now 
                    none remain.</p>
            </div>              
        </div>
        
        <p>Demo text from <a href="https://en.wikipedia.org/">Wikipedia, the free encylopedia</a></p>

        
    </div>    
    
@endsection


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/InventPartners/bootstrap-responsive-tabs/master/jquery.responsivetabs.js"></script>
    <script>
        $(function() {
            $('.nav-tabs').responsiveTabs();
        });
    </script>
