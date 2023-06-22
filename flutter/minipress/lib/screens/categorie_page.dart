import 'package:flutter/material.dart';
import '../models/categorie.dart';
import '../providers/article_provider.dart';
import 'article_filter_page.dart';
import 'article_page.dart';
import 'package:provider/provider.dart';

class CategoriePage extends StatefulWidget {
  final Categorie categorie;

  const CategoriePage({Key? key, required this.categorie}) : super(key: key);

  @override
  _CategoriePageState createState() => _CategoriePageState();
}

class _CategoriePageState extends State<CategoriePage> {
  @override
  void initState() {
    super.initState();
    Provider.of<ArticleProvider>(context, listen: false)
        .fetchArticlesCategorie(widget.categorie.id);
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<ArticleProvider>(
      builder: (context, articleProvider, _) {
        print(widget.categorie.id);
        return WillPopScope(
          onWillPop: () async {
            Provider.of<ArticleProvider>(context, listen: false).fetchArticles();
            return true;
          },
          child: Scaffold(
            appBar: AppBar(
              backgroundColor: Colors.grey[800],
              title: Row(
                children: [
                  IconButton(
                    icon: Icon(Icons.search),
                    color: Colors.white,
                    onPressed: () {
                      showSearch(
                        context: context,
                        delegate: ArticleSearchDelegate(
                            articleProvider.filteredArticles),
                      );
                    },
                    tooltip: 'Rechercher',
                  ),
                  Text(
                    widget.categorie.titre,
                    style: TextStyle(
                      color: Colors.white,
                    ),
                  ),
                ],
              ),
            ),
            body: Container(
              padding: EdgeInsets.all(16.0),
              child: ListView.builder(
                itemCount: articleProvider.filteredArticles.length,
                itemBuilder: (context, index) {
                  final article = articleProvider.filteredArticles[index];
                  return Card(
                    elevation: 2,
                    margin: EdgeInsets.symmetric(vertical: 8, horizontal: 16),
                    child: ListTile(
                      title: Text(
                        article.titre,
                        style: TextStyle(
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      subtitle: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          SizedBox(height: 4),
                          Text(
                            'Auteur: ${article.auteur}',
                            style: TextStyle(
                              color: Colors.grey[700],
                            ),
                          ),
                          SizedBox(height: 2),
                          Text(
                            'Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}',
                            style: TextStyle(
                              color: Colors.grey[700],
                            ),
                          ),
                          SizedBox(height: 4),
                        ],
                      ),
                      onTap: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) =>
                                ArticlePage(article: article),
                          ),
                        );
                      },
                    ),
                  );
                },
              ),
            ),
          ),
        );
      },
    );
  }
}
