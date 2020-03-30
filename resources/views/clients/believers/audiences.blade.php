@extends('layouts.client_layout')
@include('clients.includes.nav', ['section' => 'believers'])

@section('subnav')
<li class="nav-item">
    <a class="btn btn-primary" href="/client/believers/invite" role="button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Invite</a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link" href="/client/believers/audiences" role=""><i class="fa fa-users" aria-hidden="true"></i> Audiences</a>
</li> --}}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Audiences</h1>
        <div class="section-header-breadcrumb">
            <form method="POST" action="/client/believers/audiences">
                @csrf
                <label>Audience Name</label>
                <input type="text" id="audience_name" name="audience_name" />
                <input type="hidden" name="client_id" id="client_id" value="{{ $client_id }}" />
                <input type="hidden" name="uploader_id" id="uploader_id" value="{{ $uploader_id }}" />
                <button class="btn btn-sm btn-primary newAudience" href="" role="button" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Create a New Audience</button>
            </form>
        </div>
    </div>

    <div class="section-body">

          <div class="card">
            <div class="card-body p-10">
                @if (count($audiences) < 1)
                    <p>Hmm, looks like you haven't created an audience yet.</p>
                @else
                <div class="table-responsive dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <table id="table_id" class="datatable-audiences table table-striped dataTable no-footer">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Believers</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($audiences as $audience)
                    <tr id="audience{{ $audience->id }}">
                        <td><a href="/client/believers/audience/{{ $audience->id }}">{{ $audience->name }}</a></td>
                        <td>{{ $audience->count }}</td>
                        <td>
                            <h5><a href="#" class="req deleteAudience" data-item-id="{{ $audience->id }}"><i class="fa fa-trash"></i></a></h5>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection
