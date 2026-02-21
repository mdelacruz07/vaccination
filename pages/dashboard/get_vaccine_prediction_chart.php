<?php
    include '../../database/connector.php';
    $next_year = "";
    // Step 1: Get yearly usage per vaccine
    $query_usage = "SELECT v.id, v.name, YEAR(vi.created_date) AS year, 
                        SUM(vi.quantity) AS total_used
                    FROM vaccines v
                    LEFT JOIN vaccine_issuance vi ON vi.vaccine_id = v.id AND vi.is_archive = 0
                    WHERE v.is_archive = 0
                    GROUP BY v.id, YEAR(vi.created_date)
                    ORDER BY v.id, YEAR(vi.created_date)";

    $result = $conn->query($query_usage);

    $vaccine_data = [];
    while($row = $result->fetch_assoc()){
        $vaccine_data[$row['id']]['name'] = $row['name'];
        $vaccine_data[$row['id']]['years'][] = (int)$row['year'];
        $vaccine_data[$row['id']]['usage'][] = (int)$row['total_used'];
    }

    // Step 2: Calculate prediction for next year
    $predictions = [];
    foreach($vaccine_data as $id => $data){
        $years = $data['years'];
        $usage = $data['usage'];

        $n = count($years);
        if($n < 2){
            $predicted = $usage[0] ?? 0;
        } else {
            $avg_x = array_sum($years)/$n;
            $avg_y = array_sum($usage)/$n;
            $num = $den = 0;
            for($i=0; $i<$n; $i++){
                $num += ($years[$i]-$avg_x)*($usage[$i]-$avg_y);
                $den += ($years[$i]-$avg_x)*($years[$i]-$avg_x);
            }
            $m = $den != 0 ? $num / $den : 0;
            $b = $avg_y - $m*$avg_x;
            $next_year = max($years)+1;
            $predicted = round($m*$next_year + $b);
        }
        $predictions[$id] = [
            'name' => $data['name'],
            'years' => $years,
            'usage' => $usage,
            'next_year' => $next_year,
            'predicted' => $predicted
        ];
    }

    // Step 3: Prepare data for Chart.js
    $chart_data = [];
    foreach($predictions as $v){
        $labels = $v['years'];
        $labels[] = $v['next_year']; // add next year
        $data_points = $v['usage'];
        $data_points[] = $v['predicted']; // add predicted value
        $chart_data[] = [
            'label' => $v['name'],
            'data' => $data_points,
            'fill' => false,
            'borderColor' => sprintf('hsla(%d, 70%%, 50%%, 0.6)', rand(0, 360)),
            'tension' => 0.2
        ];
    }

    $all_years = [];
    foreach($predictions as $v){
        $all_years = array_merge($all_years, $v['years']);
    }
    $all_years[] = $next_year;
    $all_years = array_unique($all_years);
    sort($all_years);

    header('Content-Type: application/json');

    return [
        'labels' => $all_years,
        'datasets' => $chart_data
    ];
?>