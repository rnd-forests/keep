<p style="text-align:center;font-size:16px;"><strong>Hi <span style="color:#2ab27b;">{{ $username }}</span>, you created a new task at Keep</strong></p>
<div style="padding: 19px;margin-bottom: 20px;background-color:#2ab27b;">
    <h3 style="color: #fff;margin: 10px 0;font-size:25px;"><strong>{{ $task_title }}</strong></h3>
    <p style="color:#333;background: #fff; padding: 25px 20px; font-size:14px; line-height:180%;">{{ $task_content }}</p>
    <ul style="padding-left:0;">
        <li style="list-style: none;color:#fff;margin-left:0;">Starting Date: <strong>{{ $starting_date }}</strong></li>
        <li style="list-style: none;color:#fff;margin-left:0;">Finishing Date: <strong>{{ $finishing_date }}</strong></li>
    </ul>
</div>
