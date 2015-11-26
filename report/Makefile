title = Lineage
date = $(shell date '+%Y%m%d')
SECTIONS = main

$(date)$(title).pdf : $(SECTIONS:=.tex) refs.bib refs.bst
	pdflatex -shell-escape -jobname $(date)$(title) main.tex
	bibtex $(date)$(title)
	pdflatex -shell-escape -jobname $(date)$(title) main.tex
	pdflatex -shell-escape -jobname $(date)$(title) main.tex

.PHONY : clean

clean :
	rm -vrf *$(title).pdf *.aux *.log *.out *.ent *.bbl *.blg _minted-*
