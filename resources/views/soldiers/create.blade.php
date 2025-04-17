@extends('layout.app')

@section('title', 'الجنود')

@section('content')
  <section class="content">

    <div class="container-fluid">
    <div class="card card-blue">
      <div class="card-header">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <h3 class="card-title">اضافة مجند جديد</h3>
      </div>
      <form action="{{ route('soldiers.store') }}"  enctype="multipart/form-data" method="POST" >
        
        @csrf
      <div class="card-body">
        <div class="row">

        <!-- name -->
        <div class="col-4">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
      @enderror


          <label for="name">الاسم</label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="ادخل اسم الجندي">
        
        </div>



        <!-- police_number -->
        <div class="col-4">
        @error('police_number')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="police_number">رقم الشرطه</label>
       
          <input type="text" class="form-control" name="police_number" placeholder="ادخل رقم الشرطه"required>
        </div>
<!-- national_id -->
        <div class="col-4">

          @error('national_id')
        <div class="text-danger">{{ $message }}</div>
      @enderror

          <label for="exampleInputFile">ادخل الرقم القومي</label>
          <input type="text" class="form-control" name="national_id" placeholder="ادخل الرقم القومي" required>
        </div>


<!-- date_of_conscription -->
        <div class="col-4">
          @error('date_of_conscription')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="date_of_conscription">تاريخ التجنيد</label>
          <input type="date" name="date_of_conscription" id="date_of_conscription" class="form-control" required>
        </div>
        <!-- discharge_from_conscription -->
        <div class="col-4">
          @error('discharge_from_conscription')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">التسريح من التجنيد</label>
          <input type="date" name="discharge_from_conscription" id="discharge_from_conscription"
          placeholder="التسريح من التجنيد" class="form-control" required>
        </div>

        <!-- governorate -->
        <div class="col-4">
          @error('governorate')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="governorate">المحافظة</label>
          <input type="text" class="form-control" name="governorate" placeholder="المحافظة">
        </div>



         
      <!-- phone_number -->
        <div class="col-4">
          @error('phone_number')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">رقم الهاتف</label>
          <input type="text" class="form-control" name="phone_number" placeholder="رقم الهاتف">
        </div>
<!-- medical_condition -->
        <div class="col-4">
          @error('medical_condition')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">الحاله الطبيه</label>
          <input type="text" class="form-control" name="medical_condition" placeholder="الحاله الطبيه">
        </div>
<!-- job -->
        <div class="col-4">
          @error('job')
        <div class="text-danger">{{ $message }}</div>
      @enderror
      <label for="job_id">الوظيفة</label>
      <select name="job_id" class="form-control">
    <option value="">اختر الوظيفة</option>
    @foreach($jobs as $job)
    <option value="{{ $job->id }}" {{ old('job_id') == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
    @endforeach
</select>
        </div>
        
<!-- notes -->
 
        <div class="col-4">
          @error('notes')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">الملاحظات</label>
          <input type="text" class="form-control" name="notes" placeholder="الملاحظات">
        </div>
<!-- start_date -->
        <div class="col-4">
          @error('start_date')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">بدايه العمل</label>
          <input type="date" class="form-control" name="start_date" placeholder="بدايه العمل">
        </div>



<!-- السريه -->
        <div class="col-4">
          @error('regiments')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">السرية</label>
          <select name="regiment_id" id="regiment_id" class="form-control" required>
          <option value="">اختر السرية</option>
          @foreach ($regiments as $regiment)
        <option value="{{ $regiment->id }}">{{ $regiment->name }}</option>
      @endforeach
          </select>
        </div>



        <!-- الدفعه -->
        <div class="col-4">
          @error('batches')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="exampleInputFile">الدفعه</label>
          <select name="batch_id"   id="batch_id" class="form-control" required>
        <option value="">-- اختر الدفعة --</option>
        @foreach($batches as $batch)
            <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                {{ $batch->name }}
            </option>
        @endforeach
    </select>
        </div>




        
   <!-- الجهة -->
        
        <div class="col-4">
          @error('authority')
        <div class="text-danger">{{ $message }}</div>
      @enderror
          <label for="authority">الجهة</label>
          <select name="authority_id" id="authority_id" class="form-control" required>
          <option value="">اختر الجهة</option>
          @foreach ($authorities as $authority)
                <option value="{{ $authority->id }}" {{ request('authority_id') == $authority->id ? 'selected' : '' }}>
                    {{ $authority->name }}
                </option>
            @endforeach
          </select>
        </div>

<!-- image -->

    
<div class="col-4">
          @error('image')
        <div class="text-danger">{{ $message }}</div>
      @enderror
           <label for="image">صورة الجندي:</label>
           <input type="file" name="image" id="image" class="form-control"  >
           </div>
        
      </div>



      <button type="submit" class="btn  btn-primary">إضافة جندي</button>
      <div style="text-align: center; padding: 1rem;">

      </div>

      </form>

      <!-- /.card-body -->
    </div>
    </div>
  </section>
@endsection