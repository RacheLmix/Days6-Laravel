<div>
    <h1>Báo cáo tổng hợp ngày {{ now()->format('d/m/Y') }}</h1>
    
    <h2>Thống kê bài viết</h2>
    <p>Tổng số bài viết: {{ $data['total_posts'] }}</p>
    <p>Bài viết mới hôm nay: {{ $data['new_posts'] }}</p>
    
    <h2>Thống kê bình luận</h2>
    <p>Tổng số bình luận: {{ $data['total_comments'] }}</p>
    <p>Bình luận mới hôm nay: {{ $data['new_comments'] }}</p>
    
    <h2>Thống kê người dùng</h2>
    <p>Tổng số người dùng: {{ $data['total_users'] }}</p>
    <p>Người dùng mới hôm nay: {{ $data['new_users'] }}</p>
</div>