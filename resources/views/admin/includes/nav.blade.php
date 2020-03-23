@section('mainnav')
<li class="nav-item <?php if ($section === 'clients') echo 'active'?>"><a href="/admin/clients" class="nav-link">Clients</a></li>
<li class="nav-item <?php if ($section === 'rewards') echo 'active'?>"><a href="/admin/rewards" class="nav-link">Rewards</a></li>
<li class="nav-item <?php if ($section === 'redeem') echo 'active'?>"><a href="/admin/redemptions" class="nav-link">Reward Redemptions</a></li>
<li class="nav-item <?php if ($section === 'mission') echo 'active'?>"><a href="/admin/missiontypes" class="nav-link">Mission Types</a></li>
<li class="nav-item <?php if ($section === 'reports') echo 'active'?>"><a href="/admin/reports" class="nav-link">Reports</a></li>
<li class="nav-item <?php if ($section === 'referrals') echo 'active'?>"><a href="/admin/referrals" class="nav-link">Referrals</a></li>
@endsection
