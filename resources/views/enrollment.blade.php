<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enrollment Confirmation</title>
</head>
<body style="margin:0; padding:0; font-family:Arial, sans-serif; background:#f4f6f8;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
<tr>
<td align="center">

    <!-- MAIN CARD -->
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

        <!-- HEADER -->
        <tr>
            <td style="background:#4e73df; color:white; padding:20px; text-align:center;">
                <h2 style="margin:0;">🎓 My LMS Platform</h2>
                <p style="margin:5px 0 0;">Course Enrollment Confirmation</p>
            </td>
        </tr>

        <!-- BODY -->
        <tr>
            <td style="padding:30px;">

                <h3>Hello {{ $user->name }}, 👋</h3>

                <p>
                    Congratulations! You have successfully enrolled in the course:
                </p>

                <!-- COURSE CARD -->
                <div style="border:1px solid #eee; padding:15px; border-radius:8px; margin:20px 0;">

                    <h3 style="margin:0; color:#333;">
                        {{ $course->title }}
                    </h3>

                    <p style="margin:10px 0; color:#666;">
                        {{ \Illuminate\Support\Str::limit($course->description, 100) }}
                    </p>

                    <p style="margin:0;">
                        <strong>Price:</strong>
                        @if($course->price > 0)
                            ₹{{ $course->price }}
                        @else
                            Free Course
                        @endif
                    </p>

                </div>

                <p>
                    You can now start learning anytime from your dashboard.
                </p>

                <!-- BUTTON -->
                <div style="text-align:center; margin:30px 0;">
                    <a href="{{ url('/student/profile') }}"
                       style="background:#4e73df; color:white; padding:12px 25px;
                              text-decoration:none; border-radius:5px; display:inline-block;">
                        🚀 Go to My Courses
                    </a>
                </div>

                <p style="color:#555;">
                    Happy Learning! <br>
                    <strong>My LMS Team</strong>
                </p>

            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td style="background:#f1f1f1; text-align:center; padding:15px; font-size:12px; color:#777;">
                © {{ date('Y') }} My LMS. All rights reserved.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>