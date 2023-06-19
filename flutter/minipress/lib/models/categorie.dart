class Categorie {
  final String id;
  final String titre;
  final String resume;

  Categorie({
    required this.id,
    required this.titre,
    required this.resume
  });

  factory Categorie.fromJson(Map<String, dynamic> json) {
  return Categorie(
    id: json['id'].toString(),
    titre: json['titre'].toString(),
    resume: json['resume'].toString(),
  );
}

}
