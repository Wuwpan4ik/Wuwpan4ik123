    <?php
        if (!class_exists('PHPMailer\PHPMailer\Exception'))
        {
            require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require '/vendor/phpmailer/phpmailer/src/SMTP.php';
            require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        }

        class UserController extends ACoreCreator {
            use GenerateRandomPassword;
            use RequestValidate;

            private $password;
            private $name;
            private $phone;

            private function GetClient($creator_id, $course_id)
            {
                return $this->user_class->GetQuery("clients", ["creator_id" => $creator_id, "course_id" => $course_id, "email" => $this->email]);
            }

            private function GetPriceOfCourse($course_id)
            {
                return $this->course->GetQuery("course", ["id" => $course_id]);
            }

            private function GetPriceOfVideo($video_id)
            {
                return $this->course_content->GetQuery("course", ["id" => $video_id]);
            }

            public function InsertToTable($creator_id, $course_id, $buy_progress, $course_price)
            {
                $current_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));

                $data = [
                    "first_name" => $this->name,
                    "email" => $this->email,
                    "tel" => $this->phone,
                    "creator_id" => $creator_id,
                    "course_id" => $course_id,
                    "give_money" => $course_price,
                    "buy_progress" => $buy_progress,
                    "achivment_date" => $current_date
                ];
                $this->clients->InsertQuery("clients", $data);
            }

            function getCourseSite()
            {
                $author_id = $_GET['author_id'];
                $user_id = $_GET['user_id'];
                $course_page = $this->user_class->GetContentForUserCoursePage($author_id, $user_id);
                $div = '';
                foreach ($course_page as $item) {
                    $name = $item['name'];
                    $div .= '
                    <div class="popup__allLessons-item availableСourses">
                        <div class="popup__allLessons-item__header">
                            <input type="text" hidden="hidden" id="id" value="' . $item['id'] . '">
                            <div class="popup-item">
                                <div class="popup__allLessons-item-video__img">
                                    <img src="'. $item['preview'] .'" alt="">
                                </div>
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor available-number">
                                            Курс
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            ' . $item['count']  . ' урока
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        ' . $name . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                echo $div;
            }

            function getDisableCourseSite()
            {
                $author_id = $_GET['author_id'];
                $course_page = $this->user_class->GetDisableContentForUserCoursePage($author_id);
                $div = '';
                foreach ($course_page as $item) {
                    $name = $item['name'];
                    $div .= '
                    <div class="popup__allLessons-item otherCourses">
                        <div class="popup__allLessons-item__header">
                            <input type="text" hidden="hidden" id="id" value="' . $item['id'] . '">
                            <div class="popup-item">
                                <div class="popup__allLessons-item-video__img">
                                    <img src="'. $item['preview'] .'" alt="">
                                </div>
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class=" aboutTheAuthor  notavailable-number">
                                            Курс
                                        </div>
                                        <div class="aboutTheAuthor-name">
                                            ' . $item['count'] . ' урока
                                        </div>
                                    </div>
                                    <div class="popup__allLessons-item-info-title">
                                        ' . $name . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                echo $div;
            }

            function getList()
            {
                $course_id = $_GET['course_id'];
                $course_page = $this->user_class->GetContentForCourseListPage($course_id);
                $purchase = $this->purchase->GetQuery("purchase", ["user_id" => $_SESSION['user']['id']]);
                $purchase_info = json_decode($purchase[0]['purchase'], true);
                $div = '';
                $counter = 1;
                foreach ($course_page as $item) {
                    $class = '';
                    $number_color = 'available-number';
                    $url_start = "<a style='position:relative;' href='/UserPlayer/" . $item['id'] . "'>";
                    $url_end = "</a>";
                    $image_available = '<img style="width: 100%; height: 100%;" src="' . $item['thubnails'] . '" alt="">';
                    $getID3 = new getID3;
                    $file = $getID3->analyze($item['video']);
                    $duration = $file['playtime_string'];
                    if (!in_array($item['id'], $purchase_info['video_id']) == 1 && !in_array($item['course_id'], $purchase_info['course_id'])) {
//                    $class = 'choice-video';
                        $number_color = 'Notavailable-number';
                        $url_start = "";
                        $url_end = "";
                        $image_available = '<img style="width: 100%; height: 100%;" src="' . $item['thubnails'] . '" alt="">';
                    }
                    $div .= '<div class="popup__allLessons-item">
                                <div class="popup__allLessons-item__header">
                            <div class="Course-item popup-item ">
                            ' . $url_start . '
                                <div class="popup__allLessons-item-video__img ' . $class . '" style="width: 76px; height: 100px;">
                                    <div data-id="' . $item['id'] . '" class="popup__allLessons-item item__list-id"></div>
                                        ' . $image_available . '
                                </div>
                                ' . $url_end . '
                                <div class="popup__allLessons-item-info">
                                    <div class="popup__allLessons-item-info-header">
                                        <div class="first_row_video" style="display:flex;align-items: center;width:100%;">
                                            <div class=" aboutTheAuthor ' . $number_color . '">
                                                Урок ' . $counter . ' 
                                            </div>
                                            <div class="duration_time">
                                                ' . $duration . '
                                            </div>
                                        </div>
                                        <div class="second_row_video" style="width:100%;">
                                            <div class="popup__allLessons-item-info-title">
                                                ' . $item['name'] . '
                                            </div>
                                        </div>
                                    </div>';
                    if ($item['description']) {
                        $div .= '
                                    <button class="accordion-button" id="accordion-button-1" aria-expanded="false">
                                    <span class="icon" aria-hidden="true"></span></button>
                                </div>
                            </div>
                                                                <div class="accordion">
                                        <div class="accordion-item">
                                            <div class="accordion-content">
                                                <p>' . $item['description'] . '</p>
                                            </div>
                                        </div></div>
                                </div>';
                    } else {
                        $div .= '
                                </div>
                                </div>
                              </div>
                            </div>';
                    }
                    $counter++;
                }
                echo $div;
            }

            function GetListForSmallPlayer() {
                $course_content = $this->course_content->ClearQuery("SELECT course_content.name,
                                                course_content.description,
                                                course_content.video,
                                                course_content.price,
                                                course_content.thubnails
                                                FROM `funnel` AS funnel
                                                INNER JOIN `course_content` AS course_content ON course_content.course_id = funnel.course_id AND funnel.id = '$id'");
                $count = 1;
                foreach ($course_content as $item) {
                    $div = '<div class="popup__allLessons-item popup-item">
                    <div class="popup__allLessons-item-video">
                        <div class="popup__allLessons-item-video__img">
                            <img src="/' . $item['thubnails'] . '" alt="">
                            <div class="popup__allLessons-item-video-play">
                                <img src="../img/smallPlayer/play.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="popup__allLessons-item-info">
                        <div class="popup__allLessons-item-info-header">
                            <div class="popup__allLessons-item-info-header-number">
                                ' . $count . '
                            </div>
                        </div>
                        <div class="popup__allLessons-item-info-title">
                            ' . $item['name'] . '
                        </div>
                    </div>
                </div>';
                    $count += 1;
                }
                echo $div;
            }

            function getBuyCourse()
            {
                $course_id = $_GET['course_id'];
                $course = $this->course->ClearQuery("SELECT course.name, course.description, course.author_id, course.price, count(course_content.id) as 'count', user.currency FROM course_content INNER JOIN course ON course_content.course_id = course.id JOIN user ON user.id = course.author_id WHERE course.id = $course_id");
                echo json_encode($course);
            }

            function getBuyVideo()
            {
                $video_id = $_GET['video_id'];
                $content = $this->course->ClearQuery("SELECT course_content.id, course_content.thubnails, course_content.name, course_content.description, course_content.video, course_content.price, course_content.query_id, user.id AS 'author_id' FROM course_content INNER JOIN course ON course_content.course_id = course.id INNER JOIN user ON course.author_id = user.id WHERE course_content.id = '$video_id'")[0];
                $getID3 = new getID3;
                $file = $getID3->analyze($content['video']);
                $duration = $file['playtime_string'];
                array_push($content, $duration);
                echo json_encode($content);
            }

            public function GetFunnelPopup()
            {
                $funnel_id = $_SESSION['item_id'];
                echo json_encode($this->funnel_content->Get()[0]['popup']);
            }

            function get_content()
            {
                // TODO: Implement get_content() method.
            }

            function obr()
            {
                // TODO: Implement obr() method.
            }
        }