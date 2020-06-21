<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Exam;
use App\Models\User;
use App\Models\Topic;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\File;
use Laracasts\Flash\Flash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Question_type;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\DataTables\ExamDataTable;
use App\Repositories\ExamRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\UpdateExamRequest;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Http\Controllers\AppBaseController;

class ExamController extends AppBaseController
{
    /** @var  ExamRepository */
    private $examRepository;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepository = $examRepo;
    }

    /**
     * Display a listing of the Exam.
     *
     * @param ExamDataTable $examDataTable
     * @return Response
     */
    public function index(ExamDataTable $examDataTable)
    {
        return $examDataTable->render('exams.index');
    }

    /**
     * Show the form for creating a new Exam.
     *
     * @return Response
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Store a newly created Exam in storage.
     *
     * @param CreateExamRequest $request
     *
     * @return Response
     */
    public function store(CreateExamRequest $request)
    {
        $input = $request->all();

        $exam = $this->examRepository->create($input);

        Flash::success('Exam saved successfully.');

        return redirect(route('exams.index'));
    }

    /**
     * Display the specified Exam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        return view('exams.show')->with('exam', $exam);
    }

    /**
     * Show the form for editing the specified Exam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        return view('exams.edit')->with('exam', $exam);
    }

    /**
     * Update the specified Exam in storage.
     *
     * @param  int              $id
     * @param UpdateExamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamRequest $request)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $exam = $this->examRepository->update($request->all(), $id);

        Flash::success('Exam updated successfully.');

        return redirect(route('exams.index'));
    }

    /**
     * Remove the specified Exam from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $this->examRepository->delete($id);

        Flash::success('Exam deleted successfully.');

        return redirect(route('exams.index'));
    }

    public function choseIlos($index = 0)
    {
        $ilos = ['Intellectual skills', 'General and transferable skills', 'Professional and practical skills', 'Knowledge and understanding'];

        return $ilos[$index % 4];
    }

    public function exam_generate_store(Request $r)
    {

        $outerChosen = []; // chosen questions Array
        $topics = $r->topics; // chosen topics (chapters) Array

        $phpWordHandle = new PhpWord(); // ini word lib

        $section = $phpWordHandle->addSection(); // start word section

        //Generate Exam
        for ($i = 1; $i <= count($r->question_num); $i++) {

            $numbering = 1;

            $question_head = Question_type::find($r->question_type[$i])->head_text;

            //Get Questions Algorithm
            /**
             * get 10 questions from each ilos category
             * choose random one
             * push into array so it dont repeats
             */

            $chosen = []; // save choosed questions

            //get 10 random questions ids
            for ($inner = 0; $inner < $r->question_count[$i]; $inner++) {
                $chosen[] = optional(Question::where('type_id', $r->question_type[$i])
                        ->where('ilos', $this->choseIlos($inner))
                        ->where('subject_id', $r->subject_id)
                        ->inRandomOrder()->whereIn('topic_id', $topics)
                        ->whereNotIn('id', $chosen)
                        ->limit(10)
                        ->first())
                    ->id;

            }

            $chosen = array_filter($chosen);
            $outerChosen = array_merge($outerChosen, $chosen);

            //get the questions
            $questions = Question::whereIn('id', $chosen)->get();

            //Start Generating
            $textrun = $section->addTextRun();

            $textrun->addText(htmlspecialchars("Question({$i}): " . $question_head . " \t ({$r->question_marks[$i]} Marks)"), array('bold' => true, 'size' => 14));
            $section->addTextBreak(1);

            $textrun = $section->addTextRun();

            if ($r->question_type[$i] != 5) { // if not multiple choice
                foreach ($questions as $value) {

                    $textrun->addText(htmlspecialchars("{$numbering}. " . $value->question), array('size' => 11));
                    $textrun->addTextBreak(1);
                    $numbering++;

                }
            } else {
                foreach ($questions as $value) {

                    //dd($value);
                    $textrun->addText(htmlspecialchars("{$numbering}. " . $value->question), array('size' => 11));
                    $textrun->addTextBreak(1);

                    $numbering++;

                    $textrun->addText(htmlspecialchars("A- " . $value->choice1), array('size' => 11));

                    $textrun->addText(htmlspecialchars("\t"));

                    $textrun->addText(htmlspecialchars("B- " . $value->choice2), array('size' => 11));
                    $textrun->addText(htmlspecialchars("\t"));

                    // $textrun->addTextBreak(1);

                    $textrun->addText(htmlspecialchars("C- " . $value->choice3), array('size' => 11));
                    $textrun->addText(htmlspecialchars("\t"));

                    $textrun->addText(htmlspecialchars("D- " . $value->choice4), array('size' => 11));

                    $textrun->addTextBreak(2);
                }
            }

            //$section->addTextBreak(1);
        }

        $objWriter = IOFactory::createWriter($phpWordHandle);
        $fullXml = $objWriter->getWriterPart('Document')->write();
        $TemplateProcessor = new TemplateProcessor(public_path('templates/exam') . '/' . $r->template);
        $TemplateProcessor->replaceBlock('exam', $this->getBodyBlock($fullXml));

        //Set Exam Values
        $TemplateProcessor->setValue('department', htmlspecialchars($r->department));
        $TemplateProcessor->setValue('dr', htmlspecialchars($r->instructor_name));
        $TemplateProcessor->setValue('level', htmlspecialchars($r->level));
        $TemplateProcessor->setValue('title', htmlspecialchars($r->title));
        $TemplateProcessor->setValue('code', htmlspecialchars($r->code));
        $TemplateProcessor->setValue('date', htmlspecialchars($r->exam_date));
        $TemplateProcessor->setValue('daytime', htmlspecialchars($r->exam_daytime));
        $TemplateProcessor->setValue('dur', htmlspecialchars($r->exam_duration));
        $TemplateProcessor->setValue('q_count', htmlspecialchars(count($r->question_num)));
        $TemplateProcessor->setValue('instructions', htmlspecialchars($r->header_instructions));
        $TemplateProcessor->setValue('exam_header_title', htmlspecialchars($r->exam_type . ' exam for ' . $r->exam_term . ' term, Academic year ' . $r->exam_year));

        $TemplateProcessor->setValue('marks', htmlspecialchars($r->total_marks));

        //save template with table
        $wordDocumentFile = $TemplateProcessor->save();

        $fileName = Str::uuid(). $r->exam_type . ' Exam - ' . $r->title . ' ' . $r->exam_date . '.docx';
        Storage::putFileAs('public', new File($wordDocumentFile), $fileName);
        $examfile = storage_path('app\\public\\' . $fileName);

        $exam = $this->examRepository->create($r->all());
        $exam->docx_file = $examfile;
        $exam->subject_id = $r->subject_id;
        $exam->type = $r->exam_type;
        $exam->user_id = Auth::id();
        $exam->file_name = $fileName;
        $exam->update();

        //dd($chosen);

        $exam->setMeta('questions', $outerChosen);

        return redirect((route('exam.report', ['exam_id' => $exam->id])));

    }

    public function examReport(Request $r)
    {
        $exam = Exam::find($r->exam_id);
        $questions_ids = $exam->getMeta('questions');

        //$ilos = ['Intellectual skills', 'General and transferable skills', 'Professional and practical skills', 'Knowledge and understanding'];

        $ilos = [];
        $topics = [];

        $ilos['is'] = Question::where('ilos', 'Intellectual skills')->whereIn('id', $questions_ids)->count();
        $ilos['gt'] = Question::where('ilos', 'General and transferable skills')->whereIn('id', $questions_ids)->count();
        $ilos['pp'] = Question::where('ilos', 'Professional and practical skills')->whereIn('id', $questions_ids)->count();
        $ilos['ku'] = Question::where('ilos', 'Knowledge and understanding')->whereIn('id', $questions_ids)->count();
        $question_sum = $ilos['is'] + $ilos['gt'] + $ilos['pp'] + $ilos['ku'];
        

        foreach (Topic::where('subject_id', $exam->subject_id)->get() as $key => $value) {
            $topics[$value->title] = Question::where('topic_id', $value->id)->whereIn('id', $questions_ids)->count();
        }

        return view('main.report')->with(['exam' => $exam, 'ilos' => $ilos, 'topics' => $topics, 'qs' => $question_sum]);
    }

    public function download_exam(Request $r)
    {
        $exam = Exam::find($r->exam_id);
        $path = $exam->docx_file;
        $fileName = $exam->file_name;
        //download file
        header('Content-Description: File Transfer');
        header('Content-Type: application/msword');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush(); // Flush system output buffer
        readfile($path);

    }


    public function download_other(Request $r)
    {
        $exam = Exam::find($r->exam_id);
        $path = $exam->docx_file;
        $fileName = $exam->file_name;

        //download file
        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush(); // Flush system output buffer
        readfile($path);

    }

    public function generate_store(Request $r)
    {
        switch ($r->exam_type) {

            case 'final':
            case 'midterm':
                //Validation
                foreach ($r->question_count as $value) {
                    if (empty($value)) {
                        Flash::error('Number Of Question is Required');
                        return redirect()->back()->with($r->query_string);
                    }
                }

                if (empty($r->topics)) {
                    Flash::error('You should choose at least one chapter');
                    return redirect()->back()->with($r->query_string);
                }

                if (empty($r->total_marks) || array_sum($r->question_marks) != $r->total_marks) {
                    Flash::error('Sum of marks must equal total marks');
                    return redirect()->back()->with($r->query_string);
                }

                return $this->exam_generate_store($r);
                break;

            case 'quiz':
            case 'assignment':
                //Validation
                foreach ($r->question_count as $value) {
                    if (empty($value)) {
                        Flash::error('Number Of Question is Required');
                        return redirect()->back()->with($r->query_string);
                    }
                }

                if (empty($r->topics)) {
                    Flash::error('You should choose at least one chapter');
                    return redirect()->back()->with($r->query_string);
                }

                if (empty($r->total_marks) || array_sum($r->question_marks) != $r->total_marks) {
                    Flash::error('Sum of marks must equal total marks');
                    return redirect()->back()->with($r->query_string);
                }

                return $this->other_generate_store($r);
                break;
        }
    }

    protected function getBodyBlock($string)
    {
        if (preg_match('%(?i)(?<=<w:body>)[\s|\S]*?(?=</w:body>)%', $string, $regs)) {
            return $regs[0];
        } else {
            return '';
        }
    }

    public function other_generate_store(Request $r)
    {
        $topics = $r->topics;

        $files = [];
        $fileName = [];
        $chosen = [];
        $outerChosen = [];

        for ($nom = 1; $nom <= $r->nom; $nom++) {

            $phpWordHandle = new PhpWord();

            $section = $phpWordHandle->addSection();

            //Generate Exam
            for ($i = 1; $i <= count($r->question_num); $i++) {
                $numbering = 1;

                $question_head = Question_type::find($r->question_type[$i])->head_text;

                //Get Questions Algorithm
                /**
                 * get 10 questions from each ilos category
                 * choose random one
                 * push into array so it dont repeats
                 */

                $chosen = []; // save choosed questions

                //get 10 random questions ids
                for ($inner = 0; $inner < $r->question_count[$i]; $inner++) {
                    $chosen[] = optional(Question::where('type_id', $r->question_type[$i])
                            ->where('ilos', $this->choseIlos($inner))
                            ->where('subject_id', $r->subject_id)
                            ->inRandomOrder()->whereIn('topic_id', $topics)
                            ->whereNotIn('id', $chosen)
                            ->limit(10)
                            ->first())
                        ->id;
                }

                $chosen = array_filter($chosen);
                $outerChosen = array_merge($outerChosen, $chosen);

                //get the questions
                $questions = Question::whereIn('id', $chosen)->get();

                //Start Generating
                $textrun = $section->addTextRun();

                $textrun->addText(htmlspecialchars("Question({$i}): " . $question_head . " \t ({$r->question_marks[$i]} Marks)"), array('bold' => true, 'size' => 14));
                $section->addTextBreak(1);

                $textrun = $section->addTextRun();

                if ($r->question_type[$i] != 5) {
                    foreach ($questions as $value) {
                        $textrun->addText(htmlspecialchars("{$numbering}. " . $value->question), array('size' => 11));
                        $textrun->addTextBreak(1);
                        $numbering++;
                    }
                } else {
                    foreach ($questions as $value) {

                        //dd($value);
                        $textrun->addText(htmlspecialchars("{$numbering}. " . $value->question), array('size' => 11));
                        $textrun->addTextBreak(1);

                        $numbering++;

                        $textrun->addText(htmlspecialchars("A- " . $value->choice1), array('size' => 11));

                        $textrun->addText(htmlspecialchars("\t"));

                        $textrun->addText(htmlspecialchars("B- " . $value->choice2), array('size' => 11));
                        $textrun->addText(htmlspecialchars("\t"));

                        // $textrun->addTextBreak(1);

                        $textrun->addText(htmlspecialchars("C- " . $value->choice3), array('size' => 11));
                        $textrun->addText(htmlspecialchars("\t"));

                        $textrun->addText(htmlspecialchars("D- " . $value->choice4), array('size' => 11));

                        $textrun->addTextBreak(2);
                    }
                }

                //$section->addTextBreak(1);
            }

            $objWriter = IOFactory::createWriter($phpWordHandle);
            $fullXml = $objWriter->getWriterPart('Document')->write();
            $TemplateProcessor = new TemplateProcessor(public_path('templates/' . $r->exam_type) . '/' . $r->template);
            $TemplateProcessor->replaceBlock($r->exam_type, $this->getBodyBlock($fullXml));

//Set Exam Values
            $TemplateProcessor->setValue('department', htmlspecialchars($r->department));
            $TemplateProcessor->setValue('dr', htmlspecialchars($r->instructor_name));
            $TemplateProcessor->setValue('level', htmlspecialchars($r->level));
            $TemplateProcessor->setValue('title', htmlspecialchars($r->title));
            $TemplateProcessor->setValue('code', htmlspecialchars($r->code));
            $TemplateProcessor->setValue($r->exam_type . '_number', htmlspecialchars($r->ass_num));
            $TemplateProcessor->setValue($r->exam_type . '_model', htmlspecialchars($nom));
            $r->exam_type == 'quiz' ? $TemplateProcessor->setValue('dur', htmlspecialchars($r->dur)) : $TemplateProcessor->setValue('due', htmlspecialchars($r->due));
            $TemplateProcessor->setValue('marks', htmlspecialchars($r->total_marks));

            //save template with table
            $wordDocumentFile = $TemplateProcessor->save();

            $fileName = $r->title . ' ' .$r->exam_type . ' #' . $r->ass_num . ' model ' . $nom . '.docx';

            $files[$nom] = $wordDocumentFile;
            $file_names[$nom] = $fileName;

        } //nom For

        $zipname = Str::uuid().$r->title . ' ' . $r->exam_type . ' #' . $r->ass_num . '.zip';

        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        $n = 1;
        foreach ($files as $file) {
            $zip->addFile($file, $file_names[$n]);
            $n++;
        }

        $zip->close();

        Storage::putFileAs('public', new File($zipname), $zipname);

        $examfile = storage_path('app\\public\\' . $zipname);

        $exam = $this->examRepository->create($r->all());
        $exam->docx_file = $examfile;
        $exam->subject_id = $r->subject_id;
        $exam->type = $r->exam_type;
        $exam->user_id = Auth::id();
        $exam->file_name = $zipname;
        $exam->update();

        //dd($chosen);

        $exam->setMeta('questions', $outerChosen);

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        return readfile($zipname);

    }

    public function generate(Request $r)
    {
        $s = Subject::where('id', $r->subject)->firstOrFail();
        $qc = $r->noq;

        return view('main.gen_exam')->with([
            's' => $s,
            'type' => $r->type,
            'qc' => $qc,
            'question_types' => Question_type::all(),
        ]);
    }

    public function other_generate(Request $r)
    {
        $s = Subject::where('id', $r->subject)->firstOrFail();
        $qc = $r->noq;

        return view('main.gen_other')->with([
            's' => $s,
            'type' => $r->type,
            'qc' => $qc,
            'question_types' => Question_type::all(),
        ]);
    }
    public function generator(Request $r)
    {
        switch ($r->type) {
            case 'final':
            case 'midterm':
                $users = User::where('id', Auth::id())->with('subjects')->first();
                return view('main.exam')->with(['type' => $r->type, 'u' => $users]);
                break;

            case 'quiz':
            case 'assignment':
                $users = User::where('id', Auth::id())->with('subjects')->first();
                return view('main.other')->with(['type' => $r->type, 'u' => $users]);
                break;

            default:
                abort(404);
                break;
        }
    }
}
