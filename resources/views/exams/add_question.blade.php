@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-0">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
                <p class="m-0">{{ $course->name }} | {{ $exam->name }} <br> {{ date('D, d M Y H:i:s' ,strtotime($exam->start_datetime)) }} s/d {{ date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)) }} WITA</p>
            </div>
        </div><!-- /.row -->
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible mb-0 mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-warning alert-dismissible mb-0 mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                {{ Session::get('error') }}
            </div>
        @endif
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('exam.store.question', [$course->id, $exam->id]) }}" method="post">  
                            @csrf
                            <table id="categories" width="100%">
                                <tr>
                                    <td width="90%">
                                        <div class="form-group mb-2">
                                            <label for="question-1">Question</label>
                                            <textarea name="question[]" class="form-control rounded-0 @error('question[]') is-invalid @enderror" id="question-1" placeholder="Input Question..." cols="30" rows="2">{{ old('question[]') }}</textarea>
                                            @error('question[]')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label for="option-1-a">Option A</label>
                                                    <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-1-a" placeholder="Input option..." type="text">
                                                    @error('option[]')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label for="option-1-b">Option B</label>
                                                    <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-1-b" placeholder="Input option..." type="text">
                                                    @error('option[]')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label for="option-1-c">Option C</label>
                                                    <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-1-c" placeholder="Input option..." type="text">
                                                    @error('option[]')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label for="option-1-d">Option D</label>
                                                    <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-1-d" placeholder="Input option..." type="text">
                                                    @error('option[]')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="category-1">Category</label>
                                                <select name="category[]" id="category-1" class="form-control">
                                                    <option disabled selected>Choose the Category...</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="true-option-1">Correct Option</label>
                                                <select name="true_option[]" id="true-option-1" class="form-control">
                                                    <option disabled selected>Choose the Correct Option...</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                    </td>
                                    <td width="10%" class="text-center mb-0">
                                        <label for="" class="mb-0"><br>    
                                        <button type="button" class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary float-right mt-2" type="submit"><i class="fas fa-save mr-2"></i> Save</button>
                                    <button type="button" class="btn btn-default float-right mt-2 mr-2" id="add-category"><i class="fas fa-plus mr-1"></i> Add More Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@push('script')
<!-- Select2 -->
<script src="{{ asset('template/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
//Date and time picker
$('#start_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });
$('#end_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });

let i = 1
$('#add-category').on('click', function(e){
    e.preventDefault()
    ++i
    let row = `
    <tr>
        <td width="90%">
            <div class="form-group mb-2">
                <label for="question-${i}">Question</label>
                <textarea name="question[]" class="form-control rounded-0 @error('question[]') is-invalid @enderror" id="question-${i}" placeholder="Input Question..." cols="30" rows="2">{{ old('question[]') }}</textarea>
                @error('question[]')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="option-${i}-a">Option A</label>
                        <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-${i}-a" placeholder="Input option..." type="text">
                        @error('option[]')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="option-${i}-b">Option B</label>
                        <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-${i}-b" placeholder="Input option..." type="text">
                        @error('option[]')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="option-${i}-c">Option C</label>
                        <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-${i}-c" placeholder="Input option..." type="text">
                        @error('option[]')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="option-${i}-d">Option D</label>
                        <input name="option[]" class="form-control rounded-0 @error('option[]') is-invalid @enderror" id="option-${i}-d" placeholder="Input option..." type="text">
                        @error('option[]')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="category-${i}">Category</label>
                    <select name="category[]" id="category-${i}" class="form-control">
                        <option disabled selected>Choose the Category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="true-option-${i}">Correct Option</label>
                    <select name="true_option[]" id="true-option-${i}" class="form-control">
                        <option disabled selected>Choose the Correct Option...</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <hr>
        </td>
        <td width="10%" class="text-center mb-0">
            <label for="" class="mb-0"><br>    
            <button type="button" class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
    `
    $('#categories').append(row)

})
$(document).on('click', '.remove-input-field', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush

