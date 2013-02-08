<?php

/**
 *
 * @author hiendh2007@gmail.com
 */
class PageController extends Controller {

    public $allPages;

    protected function beforeAction() {
        $this->allPages = $this->dataStore()->all();
        return true;
    }

    public function actionIndex() {
        // find homepage

        $page = $this->dataStore()->findOne('isHomePage', 1);
        $data = array(
            'model' => $page,
        );

        if ($page) {
            $this->render('index', $data);
        } else {
            $this->render('notfound', $data);
        }
    }

    public function actionCreate() {
        if ($this->checkLogin()) {
            $page = new Page();
            if (isset($_POST['Page'])) {
                $valid = true;
                $page->setAttributes($_POST['Page'], false);                
                $page->id = uniqid();
                if ($page->validate()) {
                    if ($this->pageNameExists($page->pageName, $page->id)) {
                        $page->addError("pageName", "Page already exists");
                        $valid = false;
                    }
                    if ($valid) {
                        $this->dataStore()->add($page);
                        $this->dataStore()->save();
                        $this->redirect(array("view", 'id' => $page->id));
                    }
                }
            }
            $data = array(
                'model' => $page,
            );
            $this->render('create', $data);
        }
    }

    public function actionUpdate($id) {
        if ($this->checkLogin()) {
            $page = $this->dataStore()->findOne('id', $id);
            if ($page) {
                if (isset($_POST['Page'])) {
                    $valid = true;
                    $page->pageName = $_POST['Page']['pageName'];
                    $page->isHomePage = $_POST['Page']['isHomePage'];
                    $page->pageContent = $_POST['Page']['pageContent'];

                    //check if page name not empty
                    if ($page->validate()) {
                        if ($this->pageNameExists($page->pageName, $page->id)) {
                            $page->addError("pageName", "Page name already exists");
                            $valid = false;
                        }
                        if ($valid) {
                            $this->dataStore()->add($page);
                            $this->dataStore()->save();
                            $this->redirect(array("view", 'id' => $page->id));
                        }
                    }
                }
                $data = array(
                    'model' => $page,
                );
               $this->render('update', $data);
            } else {
                $this->render('notfound');
            }
        }
    }
public function buildLeftMenu() {
        ?>
        <div id="LeftMenu">
        <?php if (!Yii::app()->user->id): ?>
            <p>
                <a href="<?php echo $this->createUrl('/site/login') ?>">Login</a>
            </p>
            <?php endif; ?>
            <?php if ($this->allPages): foreach ($this->allPages as $page): ?>
                    <p>
                        <a href="<?php echo $this->createUrl('page/view', array('id' => $page->id)) ?>"><?php echo $page->pageName; ?></a>
                    </p>
                <?php
            endforeach;
        endif;
        ?>
        <?php if (Yii::app()->user->id): ?>
                <p>
                    <a href="<?php echo $this->createUrl('page/create') ?>">Add new page</a> 
                </p>
                <p>      
                    <a href="<?php echo $this->createUrl('/site/logout') ?>">Logout</a>
                </p>  

        <?php endif; ?>
        </div>
        <?php
    }
    public function actionView($id) {
        $page = $this->dataStore()->findOne('id', $id);
        if($page){
            return $this->render('view', array('model' => $page));
        } else {
             return $this->render('notfound');
        }
    }

   

    /**
     * check a page name is existed, copied from SilverStripe Src
     */
    public function pageNameExists($name, $existingId) {
        $existing = $this->dataStore()->findOne('pageName', $name);
        if ($existing && !($existing->id == $existingId)) {
            return true;
        }
        return false;
    }

    /**
     * Checks whether a page exists already or not, copied from SilverStripe Src
     * 
     * @param type $name
     * @param type $existingId
     * @return type 
     */
    public function actionCheckName() {
        $this->layout = '';
        header('Content-type: application/json');
        
        $name = $_GET['name'];
        $id = $_GET['id'];
        echo $this->pageNameExists($name, $id) ? json_encode(array("exists"=>true)): json_encode(array("exists"=>false));
        exit;
    }

}
?>
