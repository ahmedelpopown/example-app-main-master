@extends('layout.app')

@section('title', 'بيانات الجنود')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- الكارت الرئيسي -->
        <div class="card">
          <div class="card-header text-right">
            <a href="{{ route('soldiers.create') }}" class="btn btn-success mb-3">➕ إضافة جندي جديد</a>
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#bulkLeaveModal">
              تحديث إجازات جماعي
            </button>
          </div>

          <!-- فلتر عرض الجنود في إجازة -->
          <form action="{{ route('soldiers.index') }}" method="GET" class="mb-3 px-3">
            <div class="form-check">
              <input type="checkbox" name="status" value="leave" class="form-check-input" id="leaveCheckBox"
                {{ request()->status == 'leave' ? 'checked' : '' }}>
              <label class="form-check-label" for="leaveCheckBox">عرض الجنود في إجازة فقط</label>
            </div>
            <button type="submit" class="btn btn-primary mt-2">تصفية</button>
          </form>

          <div class="card-body">
            <table id="soldiersTable" class="table table-bordered table-striped text-center">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectAll"></th>
                  <th>ID</th>
                  <th>الاسم</th>
                  <th>الصورة</th>
                  <th>رقم الشرطة</th>
                  <th>الرقم القومي</th>
                  <th>تاريخ التجنيد</th>
                  <th>التسريح</th>
                  <th>المحافظة</th>
                  <th>الهاتف</th>
                  <th>السرية</th>
                  <th>الحالة الطبية</th>
                  <th>الجهة</th>
                  <th>الوظيفة</th>
                  <th>بداية العمل</th>
                  <th>ملاحظات</th>
                  <th>الحالة</th>
                  <th>العمليات</th>
                  <th>حالة خاصة</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($soldiers as $soldier)
                <tr>
                  <td><input type="checkbox" class="row-checkbox" value="{{ $soldier->id }}"></td>
                  <td>{{ $soldier->id }}</td>
                  <td>{{ $soldier->name }}</td>
                  <td>
                    @if($soldier->image)
                      <img src="{{ asset('storage/' . $soldier->image) }}" width="80" alt="صورة">
                    @else
                      لا توجد صورة
                    @endif
                  </td>
                  <td>{{ $soldier->police_number }}</td>
                  <td>{{ $soldier->national_id }}</td>
                  <td>{{ $soldier->date_of_conscription }}</td>
                  <td>{{ $soldier->discharge_from_conscription }}</td>
                  <td>{{ $soldier->governorate }}</td>
                  <td>{{ $soldier->phone_number }}</td>
                  <td>{{ $soldier->regiment->name ?? 'غير محدد' }}</td>
                  <td>{{ $soldier->medical_condition }}</td>
                  <td>{{ $soldier->authority }}</td>
                  <td>{{ $soldier->job->name }}</td>
                  <td>{{ $soldier->start_date }}</td>
                  <td>{{ $soldier->notes }}</td>
                  <td>{{ $soldier->status == 'working' ? 'في الخدمة' : ($soldier->status == 'leave' ? 'في إجازة' : 'غير محدد') }}</td>
                  <td>
                    <a href="{{ route('soldiers.edit', $soldier->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                    <form action="{{ route('soldiers.destroy', $soldier->id) }}" method="POST" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                    </form>
                  </td>
                  <td>{{ $soldier->special_case }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal لتحديد مواعيد الإجازة -->
<div class="modal fade" id="bulkLeaveModal" tabindex="-1" role="dialog" aria-labelledby="bulkLeaveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bulkLeaveModalLabel">تحديد مواعيد الإجازة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="bulkLeaveForm" action="{{ route('soldiers-data.bulkLeave') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="startLeave">تاريخ بداية الإجازة</label>
            <input type="date" class="form-control" id="startLeave" name="start_leave" required>
          </div>
          <div class="form-group">
            <label for="endLeave">تاريخ نهاية الإجازة</label>
            <input type="date" class="form-control" id="endLeave" name="endLeave" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-primary">تحديث الإجازات</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts-database')
<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & dashboard/Plugins -->
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>

<script>
$(document).ready(function() {
  // تحديد/إلغاء تحديد كل الصفوف
  $('#selectAll').click(function() {
    $('.row-checkbox').prop('checked', this.checked);
  });

  // إعداد DataTable
  var table = $("#soldiersTable").DataTable({
    responsive: true,
    lengthChange: true,
    pageLength: 50,
    autoWidth: false,
    scrollX: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"
    },
    dom: '<"top"Bfrtip><"bottom"lip>',
    buttons: [
      { 
        extend: 'colvis',
        text: '🧩 أعمدة',
        columns: ':not(:first):not(:last)' 
      },
      { extend: 'copy', text: '📋 نسخ' },
      { extend: 'excel', text: '📥 Excel' },
      { extend: 'pdf', text: '📄 PDF' },
      { extend: 'print', text: '🖨️ طباعة' }
    ],
    columnDefs: [
      { orderable: false, targets: [0, 17] }, // تعطيل الترتيب لأعمدة الاختيار والعمليات
      { width: '30px', targets: 0 }, // تحديد عرض عمود الاختيار
      { width: '80px', targets: 3 }  // تحديد عرض عمود الصورة
    ]
  });

  
})
$('#bulkLeaveForm').submit(function(e) {
    e.preventDefault();
    
    // جمع الجنود المحددين
    var selected = [];
    $('.row-checkbox:checked').each(function() {
        selected.push($(this).val());
    });

    if (selected.length === 0) {
        alert('الرجاء تحديد جنود لتحديث حالتهم');
        return false;
    }

    // إعداد البيانات
    var formData = {
        soldiers: selected,
        start_leave: $('#startLeave').val(),
        end_leave: $('#endLeave').val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    // إرسال البيانات
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr) {
            var errorMsg = 'حدث خطأ غير متوقع';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            alert(errorMsg);
            console.error(xhr.responseText);
        }
    });
});
</script>
@endpush