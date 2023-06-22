import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/categorie.dart';
import '../providers/api_provider.dart';
import '../providers/article_provider.dart';
import 'article_filter_page.dart';
import 'article_page.dart';
import 'categorie_page.dart';
import 'package:provider/provider.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Categorie> categories = [];

  @override
  void initState() {
    super.initState();
    fetchCategories();
    Provider.of<ArticleProvider>(context, listen: false).fetchArticles();
  }

  Future<void> fetchCategories() async {
    final response = await ApiProvider.get('/api/categories');

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final List<dynamic> categoriesJson = data['categories'];

      setState(() {
        categories = categoriesJson
            .map((json) => Categorie.fromJson(json))
            .toList();
      });
    } else {
      throw Exception('Failed to fetch categories');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<ArticleProvider>(
      builder: (context, articleProvider, _) {
        return Scaffold(
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
                        articleProvider.filteredArticles,
                      ),
                    );
                  },
                  tooltip: 'Rechercher',
                ),
                Spacer(),
                Text(
                  'MiniPress',
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    color: Colors.white,
                  ),
                ),
                Spacer(),
              ],
            ),
            actions: [
              IconButton(
                icon: Icon(Icons.sort_by_alpha),
                color: Colors.white,
                onPressed: articleProvider.toggleSortOrder,
                tooltip: articleProvider.isDescendingOrder
                    ? 'Trié par ordre croissant'
                    : 'Trié par ordre décroissant',
              ),
            ],
          ),
          body: Column(
            children: [
              Container(
                height: 50,
                color: Colors.grey[200],
                child: ListView.builder(
                  scrollDirection: Axis.horizontal,
                  itemCount: categories.length,
                  itemBuilder: (context, index) {
                    final categorie = categories[index];
                    return Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: GestureDetector(
                        onTap: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) =>
                                  CategoriePage(categorie: categorie),
                            ),
                          );
                        },
                        child: Chip(
                          label: Text(
                            categorie.titre,
                            style: TextStyle(
                              color: Colors.white,
                            ),
                          ),
                          backgroundColor: Colors.blueGrey,
                        ),
                      ),
                    );
                  },
                ),
              ),
              Expanded(
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
            ],
          ),
        );
      },
    );
  }
}
