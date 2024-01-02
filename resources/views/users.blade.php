@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')

<div class="dash-body" style="margin-top: 15px ">
    <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
        <tr>
            <td colspan="1" class="nav-bar">
                <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>
            </td>
            <td width="25%">
            </td>
            <td width="15%">
                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                    Today's Date
                </p>
                <p class="heading-sub12" style="padding: 0;margin: 0;">
                </p>
            </td>
            <td width="10%">
                <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="{{ url('image/calendar.svg')}}" width="100%"></button>
            </td>
        </tr>
        <table border="0" width="100%">
            <tr>
                <td>
                    <center>
                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                            <table width="90%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Name
                                        </th>
                                        <th class="table-headin">
                                            events
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </table>
</div>
<script>
    $(function() {
        var settings = {
            "url": "http://localhost/dashboard/users/getAllAdminUsers",
            "method": "GET",
            "timeout": 0,
            "headers": {},
        };
        $.ajax(settings).done(function(response) {
            console.log(response);
            if (response.status === 200) {
                response.data.forEach(element => {
                    $('#tableBody').append(`<tr>
                                            <th>${element.userName}</th>
                                            <th>
                                                <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                                    <font class="tn-in-text">View</font>
                                                </button>
                                                <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                                    <font class="tn-in-text">File</font>
                                                </button>
                                                <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                                    <font class="tn-in-text">Pdf</font>
                                                </button>
                                                <button class="btn-primary-soft btn " style="padding-left: 20px;padding-top: 8px;padding-bottom: 8px;margin-top: 10px;">
                                                    <font class="tn-in-text">Reject</font>
                                                </button>
                                            </th>
                                        </tr>`);
                });
            }
        });
    })
</script>
@endsection