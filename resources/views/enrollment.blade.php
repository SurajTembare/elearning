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
                <h2 style="margin:0;">🎓 My LMS</h2>
                <p style="margin:5px 0 0; font-size:13px;">Learn. Grow. Succeed.</p>
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

                    <!-- PRICE -->
                    <p style="margin:5px 0;">
                        <strong>Amount Paid:</strong><br>

                        @if($course->is_discount_active)
                            <span style="text-decoration:line-through; color:#999;">
                                ₹{{ $course->price }}
                            </span>
                            <span style="color:green; font-weight:bold;">
                                ₹{{ $course->final_price }}
                            </span>
                            <small style="color:red;">
                                ({{ $course->discount_percent }}% OFF)
                            </small>
                        @elseif($course->price > 0)
                            ₹{{ $course->price }}
                        @else
                            Free Course
                        @endif
                    </p>

                    <!-- ENROLL DATE -->
                    <p style="margin-top:8px;">
                        <strong>Enrolled On:</strong> {{ now()->format('d M Y') }}
                    </p>

                    <!-- LECTURES -->
                    <p style="margin-top:5px;">
                        <strong>Total Lectures:</strong> {{ $course->lectures->count() ?? 'N/A' }}
                    </p>

                    <!-- OFFER INFO -->
                    @if($course->is_discount_active)
                        <p style="color:#e74c3c; font-size:14px;">
                            🎉 You enrolled with a {{ $course->discount_percent }}% discount!
                        </p>
                    @endif

                </div>

                <p>
                    You can now start learning anytime from your dashboard.
                </p>

                <!-- BUTTONS -->
                <div style="text-align:center; margin:30px 0;">

                    <a href="{{ route('course.details',$course->id) }}"
                       style="background:#28a745; color:white; padding:12px 25px;
                              text-decoration:none; border-radius:5px; display:inline-block; margin-right:10px;">
                        ▶ Start Course
                    </a>

                    <a href="{{ url('/student/profile') }}"
                       style="background:#4e73df; color:white; padding:12px 25px;
                              text-decoration:none; border-radius:5px; display:inline-block;">
                        🚀 My Courses
                    </a>

                </div>

                <!-- SUPPORT -->
                <p style="margin-top:20px; font-size:14px; color:#777;">
                    If you face any issues, feel free to contact our support team.
                </p>

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