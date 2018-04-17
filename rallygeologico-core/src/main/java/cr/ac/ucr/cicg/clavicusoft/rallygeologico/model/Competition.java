package cr.ac.ucr.cicg.clavicusoft.rallygeologico.model;

import javax.persistence.*;
import java.sql.Timestamp;
import java.util.Date;
import java.util.Set;

@Entity
@Table(name = "Competition")
public class Competition extends BasicEntity {

    @Id
    @Column(name="CompetitionId")
    private String competitionId;

    @Column(name="Name")
    private String name;

    @Column(name="IsActive")
    private boolean isActive;

    @Column(name="IsPublic")
    private boolean isPublic;

    @Column(name="StartingDate")
    private Timestamp startingDate;

    @Column(name="FinishingDate")
    private Timestamp finishingDate;

    @ManyToOne()
    private Rally rally;

    @OneToOne(mappedBy="Admin")
    private User admin;

    @OneToMany(mappedBy="Invitations")
    private Set<Invitation> invitations;

    @Override
    public boolean onEquals(Object o) {
        return false;
    }

    @Override
    public int onHashCode(int result) {
        return 0;
    }
}
