<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deals</title>

    <style>
        table {
            border-collapse: collapse;
            margin: 2em auto;
        }
        th, td {
            padding: 0.5em;
            border: 0.5px solid;
        }
        .hidden {
            display: none;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src='/filter.js'></script>
</head>

<body>
    <div style="margin: 2em auto; max-width: fit-content;">
        <fieldset style="display: flex; flex-direction: column; gap: 0.5em; max-width: fit-content;">
            <legend>Filters</legend>
            <div>
                <input type="checkbox" data-filter id="checkbox_won" name="WON" checked>
                <label for="checkbox_won">Won</label>
            </div>

            <div>
                <input type="checkbox" data-filter id="checkbox_lose" name="LOSE" checked>
                <label for="checkbox_lose">Lose</label>
            </div>
        </fieldset>

        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>status</th>
                    <th>amount</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $data = file_get_contents('mock_deals.json');

                    $deals = json_decode($data);

                    foreach ($deals as $deal) {
                        echo "<tr class='hidden'>
                            <td>$deal->id</td>
                            <td>$deal->title</td>
                            <td data-status>$deal->status</td>
                            <td>$deal->amount</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    <div>
</body>
</html>