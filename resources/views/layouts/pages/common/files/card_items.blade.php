<div class="col-md-12">
    <div class="row">
        @foreach ($statuses as $status)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ strtoupper($status) }}</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($cards as $card)
                            @if($card->status == $status)
                                <a href="{{ route('cards.show', $card->id) }}" target="_blank">
                                    <div id="div{{ $card->id }}" class="row border p-2" ondrop="drop(event)" ondragover="allowDrop(event)">
                                        <h5 id="drag{{ $card->id }}" draggable="true" ondragstart="drag(event)">{{ $card->name }}</h5>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
