<?php
namespace MiniPress\app\action;
use MiniPress\app\service\article\ArticleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action pour traiter la soumission du formulaire de création d'article
 */
class postFormulaireArticleAction
{
    /**
     * Exécute l'action pour traiter la soumission du formulaire de création d'article
     *
     * @param ServerRequestInterface $request La requête HTTP reçue
     * @param ResponseInterface $response La réponse HTTP à renvoyer
     * @param array $args Les arguments de la route
     * @return ResponseInterface La réponse HTTP redirigeant vers la page des articles
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $article = $request->getParsedBody();
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();
        // Vérifie si l'utilisateur est connecté
        if(isset($_SESSION['user'])){
            $auteur = $_SESSION['user']->login;
        }else{
            // Redirige vers la page des articles si l'utilisateur n'est pas connecté
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('articles');
            return $response->withHeader('Location', $url)->withStatus(302);
        }
        // Construit les données de l'article à partir des champs du formulaire
        $articleData = [
            'titre' => $article['titre'],
            'resume' => $article['resume'],
            'contenu' => $article['contenu'],
            'categorie' => $article['categorie'],
            'auteur' => $auteur,
        ];

        $articleService = new ArticleService();
        // Ajoute l'article
        $articleService->addArticle($articleData);
        // Redirige vers la page des articles
        return $response->withStatus(302)->withHeader('Location', $routeParser->urlFor('articles'));
        
    }
}