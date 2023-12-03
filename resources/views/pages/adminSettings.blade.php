@extends('pages.navigator')
@section('contentAdmin')
    <<style>
    .schedule-label {
        font-size: 20px; /* Adjust the size as needed */
        font-weight: bold; /* Make the text bold */
    }
</style>

<div class="container-fluid p-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <span class="schedule-label">MANAGE SYSTEM SETTINGS</span>
                </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-backup-tab" data-bs-toggle="tab" data-bs-target="#nav-backup" type="button" role="tab" aria-controls="nav-backup" aria-selected="true"><i class="fa-solid fa-database mr-2"></i> Back Database</button>
                      <button class="nav-link" id="nav-restore-tab" data-bs-toggle="tab" data-bs-target="#nav-restore" type="button" role="tab" aria-controls="nav-restore" aria-selected="false"><i class="fa-solid fa-recycle  mr-2"></i> Restore Database</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    @include('pages.adminRestore')
                  </div>
            </div>
        </div>
    </div>
@endsection
@include('pages.Modals.manageProfile')
