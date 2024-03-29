<?php
namespace App\Controller;
use App\Entity\DecPsa;
use App\Entity\Oddelenia;
use App\Entity\Zaznam;
use App\Form\ZaznamType;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response ;

class DefaultController extends AbstractController
{


    /**
     * @Route(path="/", name="index_action")
     */
    public function home () {
        return $this->render('default/zoznam.html.twig');
    }


//    /**
//     * @Route(path="/zaznam_form", methods={"POST"},name="home_upload")
//     * @param Request $request
//     */
    public function home_Action (Request $request, EntityManagerInterface $em) {
        $zaznamData = new Zaznam();
        $form = $this->createForm(ZaznamType::class, $zaznamData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             /** @var UploadedFile  $file */
            if (!empty($form->get('fotka'))) {
                $file = $form->get('fotka')->getData();
                if(!empty($file)) {
                    $fileName = md5(uniqid()).'.'.$file->guessExtension() ;
                    $file->move($this->getParameter('upload_directory'), $fileName);
                    $zaznamData->setFotka($fileName);
                }


            $em->persist($zaznamData);
            $em->flush();
            }

            $id = $zaznamData->getId();
            $locale = $request->getLocale();
            $nazov = $zaznamData->getNazovSkusky();
            dump($locale);

            $ucastnici = $zaznamData->getUcastniciSkusky();
            $ucastnici[] = "cc";


            /** @var Oddelenia[] $oddelenia */
            $oddelenia = $em->getRepository(Oddelenia::class)->findBy(['oddelenie' => $ucastnici]);
            $mailyArr = [];
            foreach ($oddelenia as $oddelenie) {
                $mailyArr[] = $oddelenie->getEmail();
            }

            $maily = implode(';', $mailyArr);
            $mail = "mailto:".$maily."?subject=Fiche d'essai/ ".$nazov."&body=http://localhost:8000/".$locale."/".$nazov."/".$id."/pdf";

            return new JsonResponse(['msg' => 'Nahrate', 'mail' => $mail,], Response::HTTP_OK);
        }

        else {
            $errors = $this->getErrorsFromForm($form);

            $data = [
                'type' => 'validation_error',
                'title' => 'There was a validation error',
                'errors' => $errors
            ];
            return new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        }


    }



    /**
     * @Route(path="skuska/{zaznam}/", name="skuska_action")
     */
    public function skuska (Zaznam $zaznam) {

        return $this->render('default/mypdf.html.twig', [
            'zaznam' => $zaznam
            ]);
    }



    /**
     * @Route(path="/{_locale}/skuska2/{zaznam}/", name="skuska2_action")
     */
    public function skuska2 (Zaznam $zaznam) {

        return $this->render('default/skuska.html.twig', [
            'zaznam' => $zaznam
        ]);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors['chyby'][] = $childErrors[0];
                }
            }
        }

        return $errors;
    }


}