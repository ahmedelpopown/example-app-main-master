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
                  <th>تغيير الحالة</th>
                  <th>حالة خاصة</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($soldiers as $soldier)
                <tr>
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
                  <td>
            

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
@endsection

@push('scripts-database')


<script>
$(document).ready(function() {

// نتأكد إننا بنستقبل event التغيير على أي select جوا الفورم
$('.update-status-form').on('change', '.status-select', function() {
  // نجيب القيمة الجديدة
  // const status = $(this).val();

  // نجيب الـ form والأي دي منه
  // const form = $(this).closest('.update-status-form');
  // const id   = form.data('id');

  // console.log('Updating soldier', id, 'to status', status);

  // نبعت الطلب
  // $.ajax({
  //   url: `/soldiers/${id}/status`,
  //   method: 'POST',
  //   data: {
  //     _token: $('meta[name="csrf-token"]').attr('content'),
  //     status: status
  //   },
  //   success: function(response) {
  //     console.log('Server responded:', response);
  //     if (response.success) {
  //       alert(response.message);
  //     } else {
  //       alert('حصل خطأ: ' + response.message);
  //     }
  //   },
  //   error: function(xhr) {
  //     console.error('AJAX error:', xhr.responseText);
  //     alert('فشل الاتصال بالسيرفر');
  //   }
  // });

});

});


</script>
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
  <script src="{{ asset('dashboard/js/showpassword.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>



  <!-- Page specific script -->
  <script>



    $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
          // تحديث الحالة باستخدام AJAX
          
    });
    $("#soldiersTable").DataTable({
  responsive: true,
  lengthChange: false,
  autoWidth: false,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"
  },
  dom: 'Bfrtip', // دي بتحدد مكان ظهور الأزرار
  buttons: [
    { extend: 'copy', text: '📋 نسخ' },
    { extend: 'excel', text: '📥 Excel' },
    { extend: 'pdf', text: '📄 PDF' },
    { extend: 'print', text: '🖨️ طباعة' },
    { extend: 'colvis', text: '🧩 إظهار/إخفاء الأعمدة' }
  ]
});
 </script>
 
  


@endpush
