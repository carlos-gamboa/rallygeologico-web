package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.util.Set;

@Entity
@Table(name = "Term")
public class Term extends BasicEntity {

    @Id
    @Column(name="termId")
    private String termId;

    @Column(name="Name")
    private String name;

    @Column(name="Description")
    private String description;

    @Column(name="ImageUrl")
    private String imageUrl;

    @Column(name="VideoUrl")
    private String videoUrl;

    @ManyToMany(mappedBy = "relatedSites")
    private Set<Site> sites;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}
