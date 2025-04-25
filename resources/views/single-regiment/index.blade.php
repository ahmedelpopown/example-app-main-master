@extends('layout.app')

@section('title', 'بيانات الجنود')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header card_header_edit">
                        <style>
                            .card_header_edit {
                                text-align: right;
                            }
                        </style>
                        <h3 class="card-title" style="font-weight: bold; font-size: 28px;">بيانات الجنود في السرية: {{ $regiment->name }}</h3>
                        <a href="{{ route('soldiers.create') }}" class="btn btn-success mb-3">➕ إضافة جندي جديد</a>
                    </div>
                    <div class="card-body">
                        <!-- نموذج إرسال إجازة جماعية -->
                        <form action="{{ route('leaves.store') }}" method="POST">
                            @csrf

                            <!-- حقول تحديد بداية ونهاية الإجازة -->
                            <div class="form-group">
                                <label for="leave_start_date">تاريخ بداية الإجازة</label>
                                <input type="date" name="leave_start_date" id="leave_start_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="leave_end_date">تاريخ نهاية الإجازة</label>
                                <input type="date" name="leave_end_date" id="leave_end_date" class="form-control" required>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>ID</th>
                                        <th>الاسم</th>
                                        <th>صورة</th>
                                        <th>رقم الشرطة</th>
                                        <th>الرقم القومي</th>
                                        <th>تاريخ التجنيد</th>
                                        <th>التسريح من التجنيد</th>
                                        <th>المحافظة</th>
                                        <th>رقم الهاتف</th>
                                        <th>الحالة الطبية</th>
                                        <th>الجهة</th>
                                        <th>الوظيفة</th>
                                        <th>ملاحظات</th>
                                        <th>حالة خاصة</th>
                                        <th>بدء العمل</th>
                                        <th>أيام العمل</th>
                                        <th>حالة الإجازة</th>
                                        <th>عمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($regiment->soldiers as $soldier)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="soldiers[]" value="{{ $soldier->id }}">
                                        </td>
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
                                        <td>{{ $soldier->medical_condition }}</td>
                                        <td>{{ $soldier->confidentiality }}</td>
                                        <td>{{ $soldier->job->name }}</td>
                                        <td>{{ $soldier->notes }}</td>
                                        <td>{{ $soldier->special_case }}</td>
                                        <td>{{ $soldier->start_date }}</td>
                                        <td>{{ $soldier->work_days }}</td>
                                        <td>{{ $soldier->status === 'leave' ? 'في إجازة' : 'في الخدمة' }}</td>
                                        <td>
                                            <a href="{{ route('soldiers.edit', $soldier->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                            <a href="{{ route('soldiers.destroy', $soldier->id) }}" class="btn btn-danger btn-sm">حذف</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary mt-3">إرسال إجازة جماعية</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts-database')
    <!-- jQuery -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "lengthChange": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [
                    { "targets": [3], "visible": true }, // الملاحظات يمكن إخفاءها من colvis
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(document).ready(function () {
            // تحديد كل الجنود عند النقر على "اختيار الكل"
            $('#select-all').on('click', function () {
                $('input[name="soldiers[]"]').prop('checked', this.checked);
            });

            // التأكد من أن هناك جنود مختارين قبل إرسال النموذج
            $('form').on('submit', function (e) {
                if ($('input[name="soldiers[]"]:checked').length == 0) {
                    e.preventDefault();
                    Swal.fire('خطأ', 'يرجى تحديد جندي واحد على الأقل لإرسال الإجازة.', 'error');
                }
            });
        });
    </script>
@endpush
