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
        <h1>Invite New Believers</h1>
        <div class="section-header-breadcrumb">
            <form method="POST" enctype="multipart/form-data" action="/clients/believers/invite">
                @csrf
                <input type="file" id="csvfile" />
                <input type="hidden" name="client_id" id="client_id" value="{{ $client_id }}" />
                <input type="hidden" name="uploader_id" id="uploader_id" value="{{ $uploader_id }}" />
                <a class="btn btn-primary uploadInvites" href="" role="button"><i class="fa fa-upload" aria-hidden="true"></i> Upload .CSV file</a>
            </form>
        </div>
    </div>

    <div class="section-body">

          <div class="card">
            <div class="card-body">
              <p>Inviting new Believers is as simple as uploading a .csv file. Here are the rules for formatting your file.</p>
              <ul>
                <li>The following fields are required:
                    <ul>
                        <li>First Name</li>
                        <li>Last Name</li>
                        <li>E-mail Address</li>
                    </ul>
                </li>
                <li>These need to be the first 3 fields in .csv file. All other fields (i.e. phone number, address, etc) will be ignored.</li>
                <li>Do not include any headers or column titles in your file.</li>
                <li><strong>Please note: The import is limited a maximum of 999 users per .csv file</strong></li>
            </ul>
            <p><strong>Example File</strong></p>
            <code style="background: whitesmoke; display: block; padding: 10px; width: 80%;">
                Arielle,Osinski,Arielle.Osinski@gmail.com<br/>
                Brandi,Rosenbaum,Brandi.Rosenbaum@gmail.com<br/>
                Mariane,Lockman,Mariane.Lockman@gmail.com<br/>
                Leora,Welch,Leora.Welch@gmail.com<br/>
                Maurine,Gleichner,Maurine.Gleichner@gmail.com<br/>
                Missouri,Parisian,Missouri.Parisian@gmail.com<br/>
                Casandra,Senger,Casandra.Senger@gmail.com<br/>
                Shawna,Howell,Shawna.Howell@gmail.com<br/>
                Jaquelin,Streich,Jaquelin.Streich@gmail.com<br/>
                Jaylon,Terry,Jaylon.Terry@gmail.com<br/>
            </code>
            </div>
          </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <h4>Sent Invitations</h4>
                <div id="accordion">

                    @foreach($invitations as $group)
                    <div class="accordion">
                        <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-{{ $loop->index }}" aria-expanded="false">
                          <h4>{{ $group[0]->batch_date }}</h4>
                        </div>
                        <div class="accordion-body collapse" id="panel-body-{{ $loop->index }}" data-parent="#accordion" style="">
                            <table class="table table-striped no-footer">
                                <thead>
                                    <tr>
                                        <td><strong>First</strong></td>
                                        <td><strong>Last</strong></td>
                                        <td><strong>E-mail</strong></td>
                                        <td><strong>Registered</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($group as $invite)
                                    <tr>
                                        <td>{{ $invite->first }}</td>
                                        <td>{{ $invite->last }}</td>
                                        <td>{{ $invite->email }}</td>
                                        <td>{{ $invite->registered }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    </section>
@endsection
