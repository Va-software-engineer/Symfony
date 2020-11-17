<?php

namespace App\Controller\Postcode;

use App\Entity\PostcodeEntity;
use App\Form\Type\PostcodeType;
use App\Service\PostcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostcodeController extends AbstractController
{
    /**
     * @Route("/postcode", name="postcodeSearchForm")
     */
    public function showForm()
    {
        $form = $this->createForm(PostcodeType::class);
        return $this->render('postcode/search-postcode-form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/search-postcode", name="doPostcodeSearch")
     */
    public function doSearch(Request $request, ValidatorInterface $validator)
    {
        $searchTerm = $request->query->get('postcode')['s'];
        $postcodeEntity =  new PostcodeEntity();
        $postcodeEntity->setSearchedText($searchTerm);
        $errors = $validator->validate($postcodeEntity);
        if (count($errors) > 0) {
            $this->addFlash(
                'error',
                'Postcode cannot be empty!'
            );
            return $this->redirectToRoute('postcodeSearchForm');
        }
        $postcodeService = new PostcodeService();
        $searhResult = $postcodeService->searchPostcode($searchTerm);
        return new Response($searhResult ? 'Valid postcode' : 'Invalid postcode');
    }
}
