<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تفقد الطلاب</title>
  <style>
    body {
      font-family: "Tajawal", sans-serif;
      background-color: #f5f5f5;
      padding: 30px;
      text-align: center;
    }
    h1 {
      color: #2c3e50;
    }
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #27ae60;
      color: #fff;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
    button {
      border: none;
      padding: 6px 14px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      font-size: 15px;
    }
    .present {
      background-color: #27ae60;
    }
    .absent {
      background-color: #e74c3c;
    }
    .status {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <h1>تفقد الطلاب</h1>
  <table id="studentsTable">
    <thead>
      <tr>
        <th>اسم الطالب</th>
        <th>اسم الحلقة</th>
        <th>رقم الهاتف</th>
        <th>الحالة</th>
        <th>إجراء</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    const tableBody = document.querySelector("#studentsTable tbody");

    // ✅ جلب الطلاب من السيرفر
    async function fetchStudents() {
      try {
        const res = await fetch("http://127.0.0.1:8000/api/students");
        const students = await res.json();

        tableBody.innerHTML = ""; // تنظيف الجدول

        students.forEach(student => {
          const row = document.createElement("tr");
          row.innerHTML = `
            <td>${student.name}</td>
            <td>${student.halaqa_name}</td>
            <td>${student.phone}</td>
            <td class="status">لم يتم التفقد بعد</td>
            <td>
              <button class="present" onclick="markAttendance(${student.id}, 'حاضر', this)">حاضر</button>
              <button class="absent" onclick="markAttendance(${student.id}, 'غائب', this)">غائب</button>
            </td>
          `;
          tableBody.appendChild(row);
        });
      } catch (error) {
        console.error("❌ فشل في جلب الطلاب:", error);
      }
    }

    // ✅ تسجيل الحضور
    async function markAttendance(studentId, status, btn) {
      try {
        const res = await fetch("http://127.0.0.1:8000/api/attendance", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify({
            student_id: studentId,
            status: status
          })
        });

        if (res.ok) {
          const statusCell = btn.closest("tr").querySelector("status");
          statusCell.textContent = status;
          statusCell.style.color = status === "حاضر" ? "green" : "red";
        } else {
          alert("حدث خطأ أثناء حفظ التفقد ❌");
        }
      } catch (error) {
        console.error("خطأ أثناء تسجيل التفقد:", error);
      }
    }

    fetchStudents();
  </script>
</body>
</html>
