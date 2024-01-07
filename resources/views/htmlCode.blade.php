@extends('layouts.dashboard')

@section('title', 'Htmo Code Page')

@section('content')
<style>
    textarea {
        width: 850px;
        height: 500px;
    }
</style>
<script src="/js/htmlCode.js"></script>

<main role="main" style="display: flex;justify-content: center;align-items: start; margin-top: 5%;" class="col-9 ">
    <main role="main" class="col-9 md-ml-sm-auto">
        <select name="" id="selectActionName">
            <option value="0">Select Action Name</option>
        </select>
        <div class="mt-5 pt-4" id="htmlCode"></div>
    </main>
    <div style="width: 120px; display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;">
        <div>
            <button id="saveChangeHtml">save chenges</button>
        </div>
    </div>
</main>
<script src="/js/bootstrap/popper.min.js"></script>
<script src="/js/bootstrap/bootstrap.min.js"></script>

@endsection