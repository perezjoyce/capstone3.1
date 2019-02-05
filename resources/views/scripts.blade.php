<!-- SCRIPT-->
@if(Auth::user()->admin)
    <script src="/js/script_admin.js"></script>
@elseif(Auth::user()->role=='teacher')
    <script src="/js/script_teacher.js"></script>
@elseif(Auth::user()->role=='student')
    <script src="/js/script_student.js"></script>
@endif