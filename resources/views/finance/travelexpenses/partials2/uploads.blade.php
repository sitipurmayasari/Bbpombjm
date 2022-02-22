<div class="tab-pane" id="tab-uploads">
    <div class="row">
        <div class="col-sm-12">
                <div class="widget-body">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover scrollit">
                            <thead>
                                <tr>
                                    <th style="text-align: center;" >NO</th>
                                    <th class="text-center" >Nama Pegawai</th>
                                    <th class="text-center" >Upload File</th>
                                </tr>
                            </thead>
                            <tbody id="uploads">
                                @php
                                    $nomor=1;
                                @endphp
                                @foreach ($upload as $item)
                                    <tr id="cellb-{{$nomor}}">
                                        <td style="text-align: center;">{{$nomor}}</td>
                                        <td> {{$item->peg->pegawai->name}}</td>
                                        <td>
                                            <input type="file" name="file-{{$nomor}}" class="btn btn-default btn-sm" id="" value="Upload File">
                                            <label><a href="{{$item->getFIleReceipt()}}" target="_blank" >{{$item->file}}</a></label>
                                        </td>
                                    </tr>
                                    @php
                                        $nomor++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                   </div>
    
                </div>
        </div>
    </div>
</div>


