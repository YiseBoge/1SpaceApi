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
    <div>
            
        <div class="">
            <div style="float: right; font-size: 14px;">Professional CV of {{ $user->personal_name }} {{ $user->father_name }} </div>
            <div style="float: left">
                <div style="font-size: 14px; font-weight:bold; margin-bottom: 10px; margin-left: 0px">{{ $user->personal_name }} {{ $user->father_name }}</div >
                @if($user->portraitProfilePictureURL() == "")
                <img src="{{ asset('default-portrait.png') }}" style="width: 92px; height: 128px" alt="">
                    
                @else
                <img src="{{ $user->portraitProfilePictureURL() }}" style="border-radius:5px" alt="">
                    
                @endif
            </div>
            <div style="margin-left: 20px;font-size: 14px; margin-top: 30px">
                <div>
                    <div><span style="color:#555">Email:</span> {{ $user->email }}</div>
                    <div><span style="color:#555">Phone:</span> {{ $user->phone_number }}</div>
                    <div><span style="color:#555">Department:</span> {{ $user->department->name }}</div>
                    <div><span style="color:#555">Position:</span> {{ $user->position->name }}</div>
                    <div><span style="color:#555">Address:</span> {{ $user->address->city }} {{ $user->address->sub_city }} {{ $user->address->kebele }}</div>
                    <div><span style="color:#555">Company:</span> {{ $user->company->name }}</div>
                    <div><span style="color:#555">Sex:</span> {{ $user->sex }}</div>
                </div>
            </div>
        </div>

        <div>
            <h4>About Me</h4>
            <hr>
            <p style="text-align: justify;">
                {{ $professionalBiography }}
            </p>
        <div>
            <h4>Work Experience</h4>
            <hr>
            <table style="width: 100%">
                <tr style="margin-bottom: 10px">
                    <th>Company</th>
                    <th>Position</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                @foreach ($workExperiences as $item)
                <tr>
                    <td>{{ $item->company_name }}</td>
                    <td>{{ $item->position }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                </tr>
                @endforeach
            </table>
        </div>

         <div>
            <h4>Education Status</h4>
            <hr>
            <table style="width: 100%">
                <tr style="margin-bottom: 10px">
                    <th>School</th>
                    <th>Level</th>
                    <th>Field Of Study</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                @foreach ($educationStatuses as $item)
                    
                <tr>
                    <td>{{ $item->school_name }}</td> 
                    <td>{{ $item->education_level }}</td> 
                    <td>{{ $item->field_of_study }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                </tr>
                    
                @endforeach
            </table>
        </div>

        <div>
            <h4>Skills</h4>
            <hr>
            <p style="text-align: justify">
                {{ $skills }}
            </p>
        </div>
    </div>

</body>
</html>