@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div>
                        <h3 class="card-title">Participantes</h3>
                    </div>
                </div>
                <a onclick="registerNotification()">Notify me when there are new attendees</a>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap  align-items-center">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Sorteado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-center">{{$user['name']}}</td>
                                    <td class="align-center">
                                        @if (isset($chosenFriends[$user['id']]))
                                            <i class="fa fa-check" style="color: green"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div><!-- col end -->
    </div>
@endsection