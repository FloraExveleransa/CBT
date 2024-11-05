<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .calendar-header h1 {
            font-size: 2rem;
        }
        .calendar-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .calendar-table {
            width: 100%;
            border-collapse: collapse;
        }
        .calendar-table th, .calendar-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            height: 100px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="calendar-header">
            <h1>Calendar</h1>
        </div>
        <div class="calendar-controls">
            <div class="btn-group">
                <button class="btn btn-light" id="prev-month">&lt; Previous</button>
                <h2 id="month-year"></h2>
                <button class="btn btn-light" id="next-month">Next &gt;</button>
            </div>
        </div>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <!-- Calendar days will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzFJH8a2r8b5A1lW/0r3m6tUjQ6SOI6p6Bv9KI65qnm2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pprn3073KE6tl6/7mW1sI6Bv9KI65qnm2" crossorigin="anonymous"></script>

    <script>
    // Calendar logic
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function generateCalendar(month, year) {
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = 32 - new Date(year, month, 32).getDate();
        const tbl = document.getElementById("calendar-body");
        tbl.innerHTML = "";
        document.getElementById("month-year").innerHTML = months[month] + " " + year;

        let date = 1;
        let firstDayIndex = (firstDayOfMonth === 0) ? 6 : firstDayOfMonth - 1; // Shift Sunday (0) to the last column

        for (let i = 0; i < 6; i++) {
            let row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");

                if (i === 0 && j < firstDayIndex || date > daysInMonth) {
                    cell.appendChild(document.createTextNode(""));
                } else {
                    let cellText = document.createElement("div");
                    cellText.textContent = date;
                    cell.appendChild(cellText);

                    date++;
                }
                row.appendChild(cell);
            }

            tbl.appendChild(row);
        }
    }

    document.getElementById("prev-month").onclick = function() {
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        currentYear = (currentMonth === 11) ? currentYear - 1 : currentYear;
        generateCalendar(currentMonth, currentYear);
    };

    document.getElementById("next-month").onclick = function() {
        currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
        currentYear = (currentMonth === 0) ? currentYear + 1 : currentYear;
        generateCalendar(currentMonth, currentYear);
    };

    generateCalendar(currentMonth, currentYear);
</script>

</body>
</html>
