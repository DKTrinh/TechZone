<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/NewsModel.php';
require_once __DIR__ . '/../models/CommentModel.php';

class NewsController extends BaseController {
    private $newsModel;
    private $commentModel;

    public function __construct($db) {
        parent::__construct($db);
        $this->newsModel = new NewsModel($db);
        $this->commentModel = new CommentModel($db);
    }

    public function index() {
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        if (!empty($keyword)) {
            $newsList = $this->newsModel->search($keyword);
        } else {
            $newsList = $this->newsModel->getPublished();
        }
        $this->render('pages/news', [
            'newsList' => $newsList,
            'keyword'  => $keyword
        ]);
    }

    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
        if (!$id) { header("Location: public_entry.php?url=news"); exit; }

        $news = $this->newsModel->getById($id);
        if (!$news) { header("Location: public_entry.php?url=news"); exit; }

        $comments = $this->commentModel->getCommentsByNews($id);
        $this->render('pages/news_detail', [
            'news'     => $news,
            'comments' => $comments
        ]);
    }

    public function addComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header("Location: public_entry.php?url=login"); exit;
            }
            $news_id = (int)$_POST['news_id'];
            $user_id = $_SESSION['user_id'];
            $content = trim($_POST['content']);
            if ($news_id > 0 && !empty($content)) {
                $this->commentModel->addComment($news_id, $user_id, $content);
            }
            header("Location: public_entry.php?url=news/detail&id=" . $news_id);
            exit;
        }
    }
}