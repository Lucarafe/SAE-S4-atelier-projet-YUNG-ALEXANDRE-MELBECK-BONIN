import 'dart:convert';
import 'package:flutter/material.dart';
import '../providers/api_provider.dart';
import '../models/article.dart';
import '../models/categorie.dart';
import 'article_page.dart';

class CategoriePage extends StatefulWidget {
  final Categorie categorie;

  const CategoriePage({Key? key, required this.categorie}) : super(key: key);

  @override
  _CategoriePageState createState() => _CategoriePageState();
}

class _CategoriePageState extends State<CategoriePage> {
  List<Article> articles = [];

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  void fetchData() async {
    await fetchArticles(widget.categorie.id);
  }

  Future<void> fetchArticles(String categoryId) async {
  final response = await ApiProvider.get('/api/categories/$categoryId/articles');
  if (response.statusCode == 200) {
    final Map<String, dynamic> data = json.decode(response.body);
    final dynamic articlesJson = data['articles'];

    if (articlesJson is List<dynamic>) {
      setState(() {
        articles = articlesJson.map((json) => Article.fromJson(json)).toList();
      });
    } else {
      throw Exception('Invalid articles data');
    }
  } else {
    throw Exception('Failed to fetch articles');
  }
}



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.categorie.titre),
      ),
      body: Container(
        padding: EdgeInsets.all(16.0),
        child: ListView.builder(
          itemCount: articles.length,
          itemBuilder: (context, index) {
            final article = articles[index];
            return ListTile(
              title: Text(article.titre),
              subtitle: Text('Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => ArticlePage(article: article),
                  ),
                );
              },
            );
          },
        ),
      ),
    );
  }
}
