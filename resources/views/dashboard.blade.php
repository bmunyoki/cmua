@extends('layouts.template')

@section('content')
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Rec Reporter</li>
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <a href="{{ url('/cases/waiting') }}" title="Click to listen to recordings">
                <div class="social-box">
                    <label></i> Waiting</label>
                    <ul>
                        <li style="border-right: none; width: 100%;">
                            <strong id="dashRecordingsNumber">0</strong>
                            <span style="color: black;">Listen</span>
                        </li>
                    </ul>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="social-box-trio">
                <label></i> Active Cases</label>
                <ul>
                    <li style="width: 25% !important;">
                        <strong id="dashActiveFGM">0</strong>
                        <span>FGM</span><br>
                        <span title="Emergency FGM Cases">
                            <span style="background-color: red; width: 30px; height: 10px; display: inline-block">&nbsp;</span>
                            <span id="dashFGMEmergency" style="display: inline-block; line-height: 25px; font-size: 14px;">0</span>
                        </span>
                    </li>
                    <li style="width: 40% !important;">
                        <strong id="dashActiveEM">0</strong>
                        <span>Early Marriage</span>
                        <span title="Emergency Early Marriage Cases">
                            <span style="background-color: red; width: 30px; height: 10px; display: inline-block">&nbsp;</span>
                            <span id="dashEMEmergency" style="display: inline-block; line-height: 25px; font-size: 14px;">0</span>
                        </span>
                    </li>
                    <li style="width: 35% !important;">
                        <strong id="dashActiveCA">0</strong>
                        <span>Child Abuse</span>
                        <span title="Emergency Child Abuse Cases">
                            <span style="background-color: red; width: 30px; height: 10px; display: inline-block">&nbsp;</span>
                            <span id="dashCAEmergency" style="display: inline-block; line-height: 25px; font-size: 14px;">0</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="social-box">
                <label>Total Cases</label>
                <ul>
                    <li>
                        <strong id="dashTotalCasesIncept">0</strong>
                        <span>Since Inception</span>
                    </li>
                    <li>
                        <strong id="dashTotalCasesYTD">0</strong>
                        <span>Year to Date</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="social-box-trio">
                <label>
                    Resolved Cases
                </label>
                <ul>
                    <li style="width: 25% !important;">
                        <strong id="dashResolvedFGM">0</strong>
                        <span>FGM</span>
                    </li>
                    <li style="width: 40% !important;">
                        <strong id="dashResolvedEM">0</strong>
                        <span>Early Marriage</span>
                    </li>
                    <li style="width: 35% !important;">
                        <strong id="dashResolvedCA">0</strong>
                        <span>Child Abuse</span>
                    </li>
                </ul>
                <small style="color: #5C5C61; text-transform: uppercase; font-size: 10px !important;">Since Inception</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div id="bar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>

        <div class="col-lg-5">
            <div id="pie" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>

    <div class="row">
        <hr>
    </div>

    <div class="row">
        &nbsp;
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Privalence Map - All Cases
                </div>
                <div class="card-body" id="prevalence" style="min-height: 500px;">
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection 
@section('customjs')
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/charts.js') }}"></script>
@endsection
