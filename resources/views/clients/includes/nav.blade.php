@section('mainnav')
<li class="nav-item <?php if ($section === 'missions') echo 'active'?>"><a href="/client/missions" class="nav-link">Missions</a></li>
<li class="nav-item <?php if ($section === 'believers') echo 'active'?>"><a href="/client/believers" class="nav-link">Believers</a></li>
<li class="nav-item <?php if ($section === 'messages') echo 'active'?>"><a href="/client/messages" class="nav-link">Messages</a></li>
<li class="nav-item <?php if ($section === 'referrals') echo 'active'?>"><a href="/client/referrals" class="nav-link">Referrals</a></li>
<li class="nav-item <?php if ($section === 'reports') echo 'active'?>"><a href="/client/reports" class="nav-link">Reports</a></li>
@endsection
