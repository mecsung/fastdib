<?php
    require_once  __DIR__ . '/controller/register-new.php';

    // Get DEAN
    $display_DEAN = "SELECT * FROM data WHERE cubicle_num LIKE 'Dean%' ";
    $result = $connection->query($display_DEAN);
    $deans = [];
    while ($row = $result->fetch_assoc()) {
        $deans[$row["cubicle_num"]] = $row["fname"][0].".".$row["lname"]." ".$row["stat"];
    }

    // Get PRORGAM CHAIR
    $display_CHAIR = "SELECT * FROM data WHERE cubicle_num LIKE 'pc-left%' ";
    $result2 = $connection->query($display_CHAIR);
    $chairs = [];
    while ($row2 = $result2->fetch_assoc()) {
        $chairs[$row2["cubicle_num"]] = $row2["fname"][0].".".$row2["lname"]." ".$row2["stat"];
    }

    // Get FACULTY
    $display_FACULTY = "SELECT * FROM data WHERE cubicle_num LIKE 'cubicle%' ";
    $result3 = $connection->query($display_FACULTY);
    $facultys = [];
    while ($row3 = $result3->fetch_assoc()) {
        $facultys[$row3["cubicle_num"]] = $row3["fname"][0].".".$row3["lname"]." ".$row3["stat"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaStDiB</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="layout-forms">
        <!-- Faculty Mapping -->
        <div class="faculty-layout">
            <div class="deans">
                <?php
                    $defaultCubicles = ['Dean-1', 'Dean-2', 'Dean-3', 'Dean-4', 'Dean-5', 'Dean-6'];
                    
                    foreach ($defaultCubicles as $cubicle) {
                        $fullName = isset($deans[$cubicle]) ? $deans[$cubicle] : $cubicle;
                        
                        $parts = explode(" ", $fullName);
                        $status = end($parts);
                        $className = strtolower($cubicle);

                        if ($status == "absent") {
                            $className = "status-absent-deans";
                            $words = explode(" ",$fullName);
                            array_splice($words, -1);
                            $fullName = implode(" ", $words);
                        }
                        if ($status == "at-desk") {
                            $className = "status-atdesk-deans";
                            $words = explode(" ",$fullName);
                            array_splice($words, -1);
                            $fullName = implode(" ", $words);
                        }
                        if ($status == "in-class") {
                            $className = "status-inclass-deans";
                            $words = explode(" ",$fullName);
                            array_splice($words, -1);
                            $fullName = implode(" ", $words);
                        }
                        if ($status == "busy") {
                            $className = "status-busy-deans";
                            $words = explode(" ",$fullName);
                            array_splice($words, -1);
                            $fullName = implode(" ", $words);
                        }

                        $isDefaultCubicle = in_array($fullName, $defaultCubicles);
                        $buttonName = $isDefaultCubicle ? "register-btn" : "update-btn";
                        $modalValue = $cubicle;
                        
                        ?>
                        
                        <button type="button"
                            class="<?php echo $className; ?>" 
                            data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                            value="<?php echo $fullName; ?>"
                            onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                        >
                        <?php echo $fullName; ?>
                        </button>
                        <?php
                    }
                ?>
            </div>
            <div class="faculty-left">
                <!-- top left program chairs -->
                <div class="section-1">
                    <?php
                        $defaultChairs = ['pc-left 1', 'pc-left 2', 'pc-left 3'];
                        
                        foreach ($defaultChairs as $cubicle2) {
                            $fullName2 = isset($chairs[$cubicle2]) ? $chairs[$cubicle2] : $cubicle2;

                            $parts = explode(" ", $fullName2);
                            $status = end($parts);
                            $className2 = strtolower($cubicle2);

                            if ($status == "absent") {
                                $className2 = "status-absent-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "at-desk") {
                                $className2 = "status-atdesk-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "in-class") {
                                $className2 = "status-inclass-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "busy") {
                                $className2 = "status-busy-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            
                            $isDefaultChair = in_array($fullName2, $defaultChairs);
                            $buttonName = $isDefaultChair ? "register-btn" : "update-btn";
                            $modalValue = $cubicle2;

                            ?>
                            <button type="button"
                                class="<?php echo $className2; ?>" 
                                data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                value="<?php echo $fullName2; ?>"
                                onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                            >
                            <?php echo $fullName2; ?>
                            </button>
                            <?php
                        }
                    ?>
                </div>
                <div class="section-2">
                    <!-- 11 to 6 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 11', 'cubicle 10', 'cubicle 9', 'cubicle 8', 'cubicle 7', 'cubicle 6'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php 
                                    // echo $fullName3. " ". $modalValue; 
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 12 to 17 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 12', 'cubicle 13', 'cubicle 14', 'cubicle 15', 'cubicle 16', 'cubicle 17'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="section-3">
                    <!-- 33 to 28 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 33', 'cubicle 32', 'cubicle 31', 'cubicle 30', 'cubicle 29', 'cubicle 28'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 34 to 39 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 34', 'cubicle 35', 'cubicle 36', 'cubicle 37', 'cubicle 38', 'cubicle 39'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="section-4">
                    <!-- 55 to 51 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 55', 'cubicle 54', 'cubicle 53', 'cubicle 52', 'cubicle 51', 'cubicle 50'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 56 to 61 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 56', 'cubicle 57', 'cubicle 58', 'cubicle 59', 'cubicle 60', 'cubicle 61'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- bottom left program chairs -->
                <div class="section-5">
                    <?php
                        $defaultChairs = ['pc-left 4', 'pc-left 5', 'pc-left 6'];
                        
                        foreach ($defaultChairs as $cubicle2) {
                            $fullName2 = isset($chairs[$cubicle2]) ? $chairs[$cubicle2] : $cubicle2;

                            $parts = explode(" ", $fullName2);
                            $status = end($parts);
                            $className2 = strtolower($cubicle2);

                            if ($status == "absent") {
                                $className2 = "status-absent-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "at-desk") {
                                $className2 = "status-atdesk-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "in-class") {
                                $className2 = "status-inclass-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "busy") {
                                $className2 = "status-busy-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }

                            $isDefaultChair = in_array($fullName2, $defaultChairs);
                            $buttonName = $isDefaultChair ? "register-btn" : "update-btn";
                            $modalValue = $cubicle2;

                            ?>
                            <button type="button"
                                class="<?php echo $className2; ?>" 
                                data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                value="<?php echo $fullName2; ?>"
                                onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                            >
                            <?php echo $fullName2; ?>
                            </button>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="faculty-right">
                <!-- top right program chairs -->
                <div class="section-1">
                    <?php
                        $defaultChairs = ['pc-left 7', 'pc-left 8', 'pc-left 9'];
                        
                        foreach ($defaultChairs as $cubicle2) {
                            $fullName2 = isset($chairs[$cubicle2]) ? $chairs[$cubicle2] : $cubicle2;

                            $parts = explode(" ", $fullName2);
                            $status = end($parts);
                            $className2 = strtolower($cubicle2);

                            if ($status == "absent") {
                                $className2 = "status-absent-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "at-desk") {
                                $className2 = "status-atdesk-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "in-class") {
                                $className2 = "status-inclass-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "busy") {
                                $className2 = "status-busy-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }

                            $isDefaultChair = in_array($fullName2, $defaultChairs);
                            $buttonName = $isDefaultChair ? "register-btn" : "update-btn";
                            $modalValue = $cubicle2;

                            ?>
                            <button type="button"
                                class="<?php echo $className2; ?>" 
                                data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                value="<?php echo $fullName2; ?>"
                                onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                            >
                            <?php echo $fullName2; ?>
                            </button>
                            <?php
                        }
                    ?>
                </div>
                <div class="section-2">
                    <!-- 1 to 5 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 5', 'cubicle 4', 'cubicle 3', 'cubicle 2', 'cubicle 1'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 18 to 22 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 18', 'cubicle 19', 'cubicle 20', 'cubicle 21', 'cubicle 22'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="section-3">
                    <!-- 27 to 23 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 27', 'cubicle 26', 'cubicle 25', 'cubicle 24', 'cubicle 23'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 40 to 44 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 40', 'cubicle 41', 'cubicle 42', 'cubicle 43', 'cubicle 44'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;
                                
                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="section-4">
                    <!-- 49 to 45 -->
                    <div class="top">
                        <?php
                            $defaultFacultys = ['cubicle 49', 'cubicle 48', 'cubicle 47', 'cubicle 46', 'cubicle 45'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                    <!-- 62 to 66 -->
                    <div class="bot">
                        <?php
                            $defaultFacultys = ['cubicle 62', 'cubicle 63', 'cubicle 64', 'cubicle 65', 'cubicle 66'];
                            
                            foreach ($defaultFacultys as $cubicle3) {
                                // $default = strtolower(str_replace('cubicle', '', $cubicle3));
                                $fullName3 = isset($facultys[$cubicle3]) ? $facultys[$cubicle3] : $cubicle3;

                                $parts = explode(" ", $fullName3);
                                $status = end($parts);
                                $className3 = strtolower($cubicle3);

                                if ($status == "absent") {
                                    $className3 = "status-absent-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "at-desk") {
                                    $className3 = "status-atdesk-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "in-class") {
                                    $className3 = "status-inclass-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }
                                if ($status == "busy") {
                                    $className3 = "status-busy-faculty";
                                    $words = explode(" ",$fullName3);
                                    array_splice($words, -1);
                                    $fullName3 = implode(" ", $words);
                                }

                                $isDefaultCFaculty = in_array($fullName3, $defaultFacultys);
                                $buttonName = $isDefaultCFaculty ? "register-btn" : "update-btn";
                                $modalValue = $cubicle3;

                                ?>
                                <button type="button"
                                    class="<?php echo $className3; ?>" 
                                    data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                    value="<?php echo $fullName3; ?>"
                                    onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                                >
                                <?php
                                    if (in_array($fullName3, $defaultFacultys)) {
                                        echo $modalValue;
                                    } else {
                                        echo $fullName3 . " " . $modalValue;
                                    }
                                ?>
                                </button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- bottom right program chairs -->
                <div class="section-5">
                    <?php
                        $defaultChairs = ['pc-left 10', 'pc-left 11', 'pc-left 12'];
                        
                        foreach ($defaultChairs as $cubicle2) {
                            $fullName2 = isset($chairs[$cubicle2]) ? $chairs[$cubicle2] : $cubicle2;

                            $parts = explode(" ", $fullName2);
                            $status = end($parts);
                            $className2 = strtolower($cubicle2);

                            if ($status == "absent") {
                                $className2 = "status-absent-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "at-desk") {
                                $className2 = "status-atdesk-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "in-class") {
                                $className2 = "status-inclass-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }
                            if ($status == "busy") {
                                $className2 = "status-busy-chairs";
                                $words = explode(" ",$fullName2);
                                array_splice($words, -1);
                                $fullName2 = implode(" ", $words);
                            }

                            $isDefaultChair = in_array($fullName2, $defaultChairs);
                            $buttonName = $isDefaultChair ? "register-btn" : "update-btn";
                            $modalValue = $cubicle2;


                            ?>
                            <button type="button"
                                class="<?php echo $className2; ?>" 
                                data-bs-toggle="modal" data-bs-target="#register-update-Modal"
                                value="<?php echo $fullName2; ?>"
                                onclick="setModalValue('<?php echo $modalValue; ?>', '<?php echo $buttonName; ?>')"
                            >
                            <?php echo $fullName2; ?>
                            </button>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="logo-meaning">
            
            <img src="assets/image.png" alt="nufi-logo">
            
            <div class="label-meaning">
                <div class="shade-at-desk desk-green"></div>
                <div class="shade-label">At Desk</div>
            </div>
            <div class="label-meaning">
                <div class="shade-at-desk desk-lightblue"></div>
                <div class="shade-label">In Class/Campus</div>
            </div>
            <div class="label-meaning">
                <div class="shade-at-desk desk-yellow"></div>
                <div class="shade-label">Not in Campus</div>
            </div>
            <div class="label-meaning">
                <div class="shade-at-desk desk-orange"></div>
                <div class="shade-label">Busy</div>
            </div>
            <div class="label-meaning test">
                DRY RUN
            </div>
            
        </div>
    </div>

    <!-- Modal Register and Update -->
    <form action="controller/register-new.php" method="POST">
        <div class="modal fade" id="register-update-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">ID Number</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="idnum" placeholder="20xx-xxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="fname" placeholder="Juan" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="lname" placeholder="Dela Cruz" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cubicle Number</label>
                        <input readonly type="text" class="form-control" id="cubicleNumber" name="cubicle_num">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" id="submitButton" class="btn btn-primary" value="Register">
                </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Errors -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body toast-custom">
                    <!-- Toast Message Here -->
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <!-- Set Modal -->
    <script>
        function setModalValue(value, buttonName) {
            document.getElementById('cubicleNumber').value = value;

            var submitButton = document.getElementById('submitButton');
            submitButton.name = buttonName;

            if (buttonName === 'register-btn') {
                submitButton.value = 'Register';
                modalTitle.textContent  = "Register New Cubicle"
            } else if (buttonName === 'update-btn') {
                submitButton.value = 'Update';
                modalTitle.textContent  = "Edit Cubicle Details"
            }
        }
    </script>
    <!-- Toast Error -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['errors'])): ?>
                var errors = <?php echo json_encode($_SESSION['errors']); ?>;
                var toastMessage = '';
                
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        toastMessage += errors[key] + '\n';
                    }
                }
                
                if (toastMessage) {
                    var toastEl = document.getElementById('liveToast');
                    var toastBody = toastEl.querySelector('.toast-body');
                    toastBody.textContent = toastMessage;
                    
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
                
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        });
    </script>
    <!-- 5 Seconds Refresh -->
    <script>
        function isModalOpen() {
            var modal = document.getElementById('register-update-Modal');
            return modal.style.display === 'block';
        }

        function refreshPage() {
            if (!isModalOpen()) {
                location.reload();
            }
        }

        // Set interval to call refreshPage every 5 seconds (5000 milliseconds)
        setInterval(refreshPage, 3000);
    </script>

    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>
