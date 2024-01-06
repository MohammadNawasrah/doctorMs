@extends('layouts.dashboard')

@section('title', 'Htmo Code Page')

@section('content')
<!-- Main Content -->
<style>
    textarea {
        width: 850px;
        height: 500px;
    }
</style>
<script src="{{mix('resources/js/htmlCode.js')}}"></script>

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
<script>

</script>
<!-- Bootstrap JS and Popper.js and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection