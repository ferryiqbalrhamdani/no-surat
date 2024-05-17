<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Nomor Surat</label>
        <nav class="nav flex-column">
            <a href="/hari-ini" class="nav-link @if($url=='hari-ini')  active  @endif">Hari Ini</a>
            <a href=" /kastem" class="nav-link @if($url=='kastem')  active  @endif">Kastem</a>
            @if(Auth::user()->role_id==1)
            <a href=" /kastem-admin" class="nav-link @if($url=='kastem-admin')  active  @endif">Kastem Admin</a>
            @endif
        </nav>
    </div><!-- component-item -->

</div><!-- az-content-left -->