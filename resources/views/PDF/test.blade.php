<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    tr:nth-child(even) {background: #CCC; border: none}
    tr:nth-child(odd) {background: #FFF; border: none}
    </style>
</head>
<body>
    <div >
            
        <div class="">
            <div class="">
                <img src="{{ asset('portrait-2.jpg') }}" alt="">
            </div>
            <div class="">
                <div>
                    <h2>{{ $user->personal_name }} {{ $user->father_name }}</h2>
                    <div>Email: {{ $user->email }}</div>
                    <div>Phone: {{ $user->phone_number }}</div>
                </div>
            </div>
        </div>

        <hr>
        <div>
            <h4>Professional Biography</h4>
            <p style="text-align: justify">
                {{ $professionalBiograpy }}
            </p>
        <div>
            <h4>Skills</h4>
            <p style="text-align: justify">
                {{$skills}}
            </p>
        </div>

        <div>
            <h3>Education Status</h3>
            <table style="width: 100%">
                <tr style="margin-bottom: 10px">
                    <th>Company</th>
                    <th>Positoin</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                @forelse ([1,2,3,4] as $item)
                    
                <tr>
                    <td>Addis Ababa City Construction Bureau</td>
                    <td>BSC</td>
                    <td>Electrical Engineering</td>
                    <td>12-09-09</td>
                    <td>12-09-09</td>
                </tr>
                @empty
                    
                @endforelse
            </table>
        </div>

        <hr>

        <div>
            <h3>Education Status</h3>
            <table style="width: 100%">
                <tr style="margin-bottom: 10px">
                    <th>School</th>
                    <th>Level</th>
                    <th>Field Of Study</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                @forelse ([1,2,3,4] as $item)
                    
                <tr>
                    <td>Addis Ababa Institute of Technology </td>
                    <td>BSC</td>
                    <td>Electrical Engineering</td>
                    <td>12-09-09</td>
                    <td>12-09-09</td>
                </tr>
                @empty
                    
                @endforelse
            </table>
        </div>

    </div>

</body>
</html>