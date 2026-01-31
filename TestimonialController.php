<?php
require_once 'Testimonials.php';

class TestimonialController {
    private $testimonialModel;

    public function __construct(Testimonials $model) {
        $this->testimonialModel = $model;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_testimonial'])) {
            $name = trim($_POST['name']);
            $text = trim($_POST['text']);
            return $this->addTestimonial($name, $text);
        }
        return null;
    }

    private function addTestimonial($name, $text) {
        if (!empty($name) && !empty($text)) {
            if ($this->testimonialModel->add($name, $text)) {
                return ['success' => true, 'message' => 'Koment u shtua me sukses!'];
            }
            return ['success' => false, 'message' => 'Diçka shkoi gabim.'];
        }
        return ['success' => false, 'message' => 'Ju lutem plotësoni të gjitha fushat.'];
    }
}
?>
