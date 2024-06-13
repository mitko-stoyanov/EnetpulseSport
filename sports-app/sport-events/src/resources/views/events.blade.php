<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/events.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enetpulse Events</title>
</head>
<body>
    <h1 class="title">Matches</h1>
    <br>
    <div class="actions">
        <div class="sort-by">
            <label for="sortOptions">Sort By:</label>
            <select id="sortOptions" name="sortOptions">
                <option disabled selected value>- select an option -</option>
                <option value="home_team_name">Home team name</option>
                <option value="away_team_name">Away team name</option>
                <option value="date">Start date</option>
            </select>
        </div>
        <div class="buttons">
            <a href="/" class="back-button">Back</a>
            <a href="#" class="other">Other</a>
        </div>
    </div>
    <table id="matchTable" class="match-results">
        <thead>
            <tr>
                <th>Date</th>
                <th>Home Team</th>
                <th></th>
                <th>Result</th>
                <th></th>
                <th>Away Team</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matches as $match)
                <tr>
                    <td>{{ $match->match_date }}</td>
                    <td>{{ $match->home_team_name }}</td>
                    <td><img src="{{ $match->home_team_image }}" alt="Home Team Logo"></td>
                    <td>{{ $match->home_team_goals}} - {{ $match->away_team_goals}}</td>
                    <td><img src="{{ $match->away_team_image }}" alt="Away Team Logo"></td>
                    <td>{{ $match->away_team_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('sortOptions').addEventListener('change', function() {
            sortTable(this.value);
        });

        function sortTable(criteria) {
            var table, rows, switching, i, x, y, shouldSwitch;

            table = document.getElementById("matchTable");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[getColumnIndex(criteria)];
                    y = rows[i + 1].getElementsByTagName("TD")[getColumnIndex(criteria)];
                    
                    if (criteria === 'date') {
                        if (new Date(x.innerHTML) > new Date(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function getColumnIndex(criteria) {
            switch(criteria) {
                case 'date':
                    return 0;
                case 'home_team_name':
                    return 1;
                case 'away_team_name':
                    return 5;
                default:
                    return 0;
            }
        }
    </script>
</body>
</html>
