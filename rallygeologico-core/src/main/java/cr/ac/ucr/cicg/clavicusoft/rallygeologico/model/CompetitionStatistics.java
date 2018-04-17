package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.sql.Timestamp;
import java.util.Date;
import java.util.Set;

@Entity
@Table(name = "CompetitionStatistics")
public class CompetitionStatistics extends BasicEntity {

    @Id
    @Column(name="FacebookId")
    private String facebookId;

    @Id
    @Column(name="CompetitionId")
    private boolean competitionId;

    @Column(name="StartingDate")
    private Timestamp startingDate;

    @Column(name="FinishingDate")
    private Timestamp finishingDate;

    @Column(name = "Points")
    private int points;

    @ManyToOne
    private User relatedUser;

    @ManyToMany(mappedBy="RelatedSites")
    private Set<Site> relatedSites;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}
