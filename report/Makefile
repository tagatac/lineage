title = Lineage
date = $(shell date '+%Y%m%d')
SECTIONS = main intro describing cubes discussion
JPGS = elaborate sparse
PNGS = connect filter

$(date)$(title).pdf : $(SECTIONS:=.tex) $(addprefix figures/, $(JPGS:=.jpg)) $(addprefix figures/, $(PNGS:=.png)) refs.bib refs.bst
	pdflatex -shell-escape -jobname $(date)$(title) main.tex
	bibtex $(date)$(title)
	pdflatex -shell-escape -jobname $(date)$(title) main.tex
	pdflatex -shell-escape -jobname $(date)$(title) main.tex

.PHONY : clean

clean :
	rm -vrf *$(title).pdf *.aux *.log *.out *.ent *.bbl *.blg _minted-*
